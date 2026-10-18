<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminStaffPermissionsTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(string $role = 'super_admin', bool $active = true): int
    {
        $now = now();

        return DB::table('admins')->insertGetId([
            'name' => 'Test Administrator',
            'email' => 'owner-' . uniqid() . '@example.test',
            'password' => Hash::make('test-password-123'),
            'role' => $role,
            'is_active' => $active,
            'last_login_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function test_staff_page_rejects_requests_without_an_admin_session(): void
    {
        $this->get(route('admin.staff.index'))->assertForbidden();
    }

    public function test_non_super_admin_cannot_open_staff_management(): void
    {
        $adminId = $this->createAdmin('content_manager');

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.staff.index'))
            ->assertForbidden();
    }

    public function test_super_admin_can_create_a_staff_account_and_action_is_logged(): void
    {
        $adminId = $this->createAdmin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->post(route('admin.staff.store'), [
                'name' => 'Programs Officer',
                'email' => 'programs@example.test',
                'role' => 'content_manager',
                'password' => 'Strong-Password-2026!',
                'password_confirmation' => 'Strong-Password-2026!',
            ])
            ->assertRedirect(route('admin.staff.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('admins', [
            'name' => 'Programs Officer',
            'email' => 'programs@example.test',
            'role' => 'content_manager',
            'is_active' => true,
        ]);

        $staff = DB::table('admins')->where('email', 'programs@example.test')->first();
        $this->assertTrue(Hash::check('Strong-Password-2026!', $staff->password));

        $this->assertDatabaseHas('admin_activity_logs', [
            'admin_id' => $adminId,
            'action' => 'staff.created',
            'subject_id' => $staff->id,
        ]);
    }

    public function test_staff_creation_rejects_short_passwords(): void
    {
        $adminId = $this->createAdmin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->from(route('admin.staff.index'))
            ->post(route('admin.staff.store'), [
                'name' => 'Weak Password User',
                'email' => 'weak@example.test',
                'role' => 'content_manager',
                'password' => 'abc',
                'password_confirmation' => 'abc',
            ])
            ->assertRedirect(route('admin.staff.index'))
            ->assertSessionHasErrors('password');

        $this->assertDatabaseMissing('admins', ['email' => 'weak@example.test']);
    }

    public function test_staff_creation_accepts_a_simple_four_character_password(): void
    {
        $adminId = $this->createAdmin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->from(route('admin.staff.index'))
            ->post(route('admin.staff.store'), [
                'name' => 'Simple Password User',
                'email' => 'simple@example.test',
                'role' => 'content_manager',
                'password' => '1234',
                'password_confirmation' => '1234',
            ])
            ->assertSessionHasNoErrors();

        $staff = DB::table('admins')->where('email', 'simple@example.test')->first();
        $this->assertNotNull($staff);
        $this->assertTrue(Hash::check('1234', $staff->password));
    }

    public function test_signed_in_admin_is_redirected_away_from_the_sign_in_page(): void
    {
        $adminId = $this->createAdmin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.login'))
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_deactivated_admin_session_still_sees_the_sign_in_page(): void
    {
        $adminId = $this->createAdmin('super_admin', false);

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.login'))
            ->assertOk();
    }

    public function test_signed_out_visitor_sees_the_admin_sign_in_page(): void
    {
        $this->get(route('admin.login'))->assertOk();
    }

    public function test_signed_in_public_user_is_redirected_from_login_and_register(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Public Member',
            'email' => 'member@example.test',
            'password' => '1234',
        ]);

        $this->actingAs($user)->get(route('login'))->assertRedirect(route('dashboard'));
        $this->actingAs($user)->get(route('register'))->assertRedirect(route('dashboard'));
    }

    public function test_public_registration_accepts_a_four_character_password(): void
    {
        $this->post(route('register.submit'), [
            'name' => 'New Member',
            'email' => 'new@example.test',
            'password' => 'abcd',
            'password_confirmation' => 'abcd',
        ])->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', ['email' => 'new@example.test']);
    }

    public function test_site_pages_list_shows_edit_page_and_preview_as_buttons(): void
    {
        $this->seed(\Database\Seeders\SitePageContentSeeder::class);
        $adminId = $this->createAdmin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.site-pages.index'))
            ->assertOk()
            ->assertSee('class="btn btn-primary btn-sm"', false)
            ->assertSee('class="btn btn-outline btn-sm"', false)
            ->assertSee('Edit page')
            ->assertSee('Preview');
    }

    public function test_super_admin_cannot_demote_or_deactivate_their_own_account(): void
    {
        $adminId = $this->createAdmin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->from(route('admin.staff.index'))
            ->put(route('admin.staff.update', $adminId), [
                'name' => 'Test Administrator',
                'email' => DB::table('admins')->where('id', $adminId)->value('email'),
                'role' => 'content_manager',
                'is_active' => 1,
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect(route('admin.staff.index'))
            ->assertSessionHasErrors('role');

        $this->assertDatabaseHas('admins', [
            'id' => $adminId,
            'role' => 'super_admin',
            'is_active' => true,
        ]);
    }

    public function test_super_admin_can_deactivate_another_admin_without_affecting_their_own_access(): void
    {
        $ownerId = $this->createAdmin();
        $otherId = DB::table('admins')->insertGetId([
            'name' => 'Second Owner',
            'email' => 'second-owner@example.test',
            'password' => Hash::make('test-password-123'),
            'role' => 'super_admin',
            'is_active' => true,
            'last_login_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->withSession(['charity_admin_id' => $ownerId])
            ->put(route('admin.staff.update', $otherId), [
                'name' => 'Second Owner',
                'email' => 'second-owner@example.test',
                'role' => 'content_manager',
                'is_active' => 0,
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect(route('admin.staff.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('admins', [
            'id' => $otherId,
            'role' => 'content_manager',
            'is_active' => false,
        ]);
        $this->assertDatabaseHas('admins', [
            'id' => $ownerId,
            'role' => 'super_admin',
            'is_active' => true,
        ]);
    }
}

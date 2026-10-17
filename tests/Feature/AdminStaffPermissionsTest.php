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
                'password' => 'short',
                'password_confirmation' => 'short',
            ])
            ->assertRedirect(route('admin.staff.index'))
            ->assertSessionHasErrors('password');

        $this->assertDatabaseMissing('admins', ['email' => 'weak@example.test']);
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

    public function test_system_will_not_remove_the_last_active_super_admin(): void
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
            ->from(route('admin.staff.index'))
            ->put(route('admin.staff.update', $otherId), [
                'name' => 'Second Owner',
                'email' => 'second-owner@example.test',
                'role' => 'content_manager',
                'is_active' => 0,
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect(route('admin.staff.index'))
            ->assertSessionHasErrors('role');

        $this->assertDatabaseHas('admins', [
            'id' => $otherId,
            'role' => 'super_admin',
            'is_active' => true,
        ]);
    }
}

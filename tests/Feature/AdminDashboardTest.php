<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_rejects_requests_without_an_admin_session(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_dashboard_shows_live_database_counts_for_an_active_admin(): void
    {
        $now = now();

        $adminId = DB::table('admins')->insertGetId([
            'name' => 'Foundation Administrator',
            'email' => 'admin@example.test',
            'password' => bcrypt('test-password'),
            'is_active' => true,
            'last_login_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::factory()->create([
            'name' => 'Recent Public User',
            'email' => 'public@example.test',
        ]);

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Welcome back, Foundation Administrator')
            ->assertSee('Public accounts')
            ->assertSee('Recent Public User')
            ->assertSee('admin@example.test')
            ->assertSee('Real figures, not demo data');
    }

    public function test_dashboard_rejects_an_inactive_admin_session(): void
    {
        $now = now();

        $adminId = DB::table('admins')->insertGetId([
            'name' => 'Inactive Administrator',
            'email' => 'inactive@example.test',
            'password' => bcrypt('test-password'),
            'is_active' => false,
            'last_login_at' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }
}

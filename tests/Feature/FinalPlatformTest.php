<?php

namespace Tests\Feature;

use Database\Seeders\SitePageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FinalPlatformTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SitePageContentSeeder::class);
    }

    private function admin(string $role = 'administrator', bool $active = true): int
    {
        return DB::table('admins')->insertGetId([
            'name' => 'Test Administrator',
            'email' => uniqid('admin-', true).'@example.test',
            'password' => bcrypt('test-password'),
            'role' => $role,
            'is_active' => $active,
            'last_login_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_public_pages_keep_their_distinct_original_layouts(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('class="hero"', false)->assertSee('Compassion in action. Hope in community.');
        $this->get(route('programs'))->assertOk()->assertSee('class="grid-4"', false)->assertSee('Accountable action');
        $this->get(route('impact'))->assertOk()->assertSee('class="stats-band"', false);
        $this->get(route('stories'))->assertOk()->assertSee('class="editorial"', false);
        $this->get(route('get-involved'))->assertOk()->assertSee('id="donation-pledge"', false);
        $this->get(route('contact'))->assertOk()->assertSee('class="contact-panel reveal', false);
    }

    public function test_reports_are_protected_and_csv_export_uses_real_records(): void
    {
        $this->get(route('admin.reports.index'))->assertForbidden();
        $admin = $this->admin('finance_manager');
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.reports.index'))->assertOk()->assertSee('Reports &amp; exports', false);

        DB::table('donations')->insert([
            'donor_name' => '=SUM(1,1)', 'email' => 'donor@example.test', 'phone' => null,
            'amount' => 25000, 'currency' => 'UGX', 'payment_method' => 'Bank transfer',
            'payment_status' => 'paid', 'reference' => 'TXN-TEST', 'donation_date' => now()->toDateString(),
            'receipt_number' => 'MRF-TEST-000001', 'admin_notes' => null, 'created_at' => now(), 'updated_at' => now(),
        ]);

        $response = $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.reports.export', ['report' => 'donations']));
        $response->assertOk()->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('donor_name', $response->streamedContent());
    }

    public function test_settings_are_admin_only_and_updates_are_audited(): void
    {
        $contentManager = $this->admin('content_manager');
        $this->withSession(['charity_admin_id' => $contentManager])->get(route('admin.settings.edit'))->assertForbidden();

        $admin = $this->admin('administrator');
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.settings.edit'))->assertOk()->assertSee('Foundation settings');
        $this->withSession(['charity_admin_id' => $admin])->put(route('admin.settings.update'), [
            'settings' => [
                'foundation_name' => 'Muhamadi R Charity Foundation Uganda',
                'public_email' => 'info@example.test',
                'public_phone' => '+256700000000',
                'office_address' => 'Kampala, Uganda',
                'notification_email' => 'alerts@example.test',
                'timezone' => 'Africa/Kampala',
            ],
        ])->assertRedirect(route('admin.settings.edit'));

        $this->assertDatabaseHas('foundation_settings', ['key' => 'notification_email', 'value' => 'alerts@example.test']);
        $this->assertDatabaseHas('admin_activity_logs', ['admin_id' => $admin, 'action' => 'settings.updated']);
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.activity-log.index'))->assertOk()->assertSee('settings.updated');
    }

    public function test_volunteer_coordinator_can_access_only_volunteer_workflows_and_reports(): void
    {
        $admin = $this->admin('volunteer_coordinator');
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.operations.index', 'volunteers'))->assertOk();
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.operations.index', 'enquiries'))->assertForbidden();
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.reports.index'))->assertOk();
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.reports.export', ['report' => 'volunteers']))->assertOk();
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.reports.export', ['report' => 'donations']))->assertForbidden();
    }

    public function test_reports_settings_and_activity_log_share_the_polished_admin_workspace(): void
    {
        $admin = $this->admin('administrator');

        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.reports.index'))
            ->assertOk()
            ->assertSee('reports-hero', false)
            ->assertSee('reports-stats', false)
            ->assertSee('Website pages');

        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.settings.edit'))
            ->assertOk()
            ->assertSee('settings-summary', false)
            ->assertSee('settings-layout', false)
            ->assertSee('View activity log');

        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.activity-log.index'))
            ->assertOk()
            ->assertSee('audit-hero', false)
            ->assertSee('audit-stats', false)
            ->assertSee('Privacy reminder');
    }

    public function test_inactive_admin_cannot_access_reports_or_settings(): void
    {
        $admin = $this->admin('administrator', false);
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.reports.index'))->assertForbidden();
        $this->withSession(['charity_admin_id' => $admin])->get(route('admin.settings.edit'))->assertForbidden();
    }
}

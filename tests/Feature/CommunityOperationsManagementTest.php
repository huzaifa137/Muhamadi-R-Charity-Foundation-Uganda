<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CommunityOperationsManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(string $role = 'content_manager', bool $active = true): int
    {
        return DB::table('admins')->insertGetId([
            'name' => 'Operations Test Admin', 'email' => uniqid('ops-', true).'@example.test',
            'password' => bcrypt('test-password'), 'role' => $role, 'is_active' => $active,
            'last_login_at' => null, 'created_at' => now(), 'updated_at' => now(),
        ]);
    }

    public function test_operations_require_active_authorised_admins(): void
    {
        $this->get(route('admin.operations.index', 'donations'))->assertForbidden();
        $finance = $this->admin('finance_manager');
        $this->withSession(['charity_admin_id' => $finance])->get(route('admin.operations.index', 'stories'))->assertForbidden();
        $inactive = $this->admin('administrator', false);
        $this->withSession(['charity_admin_id' => $inactive])->get(route('admin.operations.index', 'enquiries'))->assertForbidden();
    }

    public function test_operations_register_uses_shared_admin_shell_and_module_navigation(): void
    {
        $admin = $this->admin('content_manager');
        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.operations.index', 'stories'))
            ->assertOk()
            ->assertSee('class="sidebar"', false)
            ->assertSee('Operations workspace')
            ->assertSee('Stories &amp; news', false)
            ->assertSee('Gallery management')
            ->assertSee('Volunteer applications')
            ->assertSee('No records here yet');
    }

    public function test_operations_editor_uses_shared_sidebar_and_field_validation_feedback(): void
    {
        $admin = $this->admin('content_manager');
        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.operations.create', 'stories'))
            ->assertOk()
            ->assertSee('class="sidebar"', false)
            ->assertSee('Create record')
            ->assertSee('Publishing & access', false)
            ->assertSee('Gallery management');
    }

    public function test_operations_navigation_hides_sections_not_allowed_for_role(): void
    {
        $admin = $this->admin('finance_manager');
        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.operations.index', 'donations'))
            ->assertOk()
            ->assertSee('Donations &amp; receipts', false)
            ->assertDontSee('Stories &amp; news', false)
            ->assertDontSee('About page')
            ->assertDontSee('Staff &amp; permissions', false);
    }

    public function test_public_donation_pledge_is_pending_until_reconciled(): void
    {
        $this->post(route('donate.submit'), [
            'donor_name' => 'Test Donor', 'email' => 'donor@example.test', 'phone' => '0700000000',
            'amount' => 25000, 'payment_method' => 'Mobile Money',
        ])->assertRedirect(route('get-involved'))->assertSessionHas('status');

        $this->assertDatabaseHas('donations', [
            'donor_name' => 'Test Donor', 'amount' => 25000, 'currency' => 'UGX', 'payment_status' => 'pending',
        ]);
        $this->assertDatabaseMissing('donations', ['donor_name' => 'Test Donor', 'payment_status' => 'paid']);
    }

    public function test_volunteer_application_is_saved_for_review(): void
    {
        $this->post(route('volunteer.submit'), [
            'name' => 'Test Volunteer', 'email' => 'volunteer@example.test', 'area_of_interest' => 'Community outreach',
            'availability' => 'Weekends', 'motivation' => 'I want to contribute skills.', 'consent' => '1',
        ])->assertRedirect(route('get-involved'));

        $this->assertDatabaseHas('volunteer_applications', ['email' => 'volunteer@example.test', 'status' => 'new']);
    }

    public function test_contact_enquiry_is_saved_and_rate_limited_route_has_named_endpoint(): void
    {
        $this->post(route('contact.submit'), [
            'name' => 'Test Sender', 'email' => 'sender@example.test', 'subject' => 'Partnership',
            'message' => 'I would like to discuss a partnership.',
        ])->assertRedirect(route('contact'));

        $this->assertDatabaseHas('contact_enquiries', ['email' => 'sender@example.test', 'status' => 'new']);
    }

    public function test_published_content_is_public_and_drafts_are_hidden(): void
    {
        DB::table('impact_records')->insert([
            'title'=>'Verified Outreach','slug'=>'verified-outreach','summary'=>'Public progress note','description'=>'Details',
            'beneficiaries_count'=>null,'status'=>'published','sort_order'=>0,'published_at'=>now(),'created_at'=>now(),'updated_at'=>now(),
        ]);
        DB::table('impact_records')->insert([
            'title'=>'Internal Draft','slug'=>'internal-draft','summary'=>'Private draft','description'=>'Details',
            'status'=>'draft','sort_order'=>1,'created_at'=>now(),'updated_at'=>now(),
        ]);
        $this->get(route('impact'))->assertOk()->assertSee('Verified Outreach')->assertDontSee('Internal Draft')->assertDontSee('1000+');
    }

    public function test_gallery_upload_is_validated_and_logged(): void
    {
        Storage::fake('public');
        $admin = $this->admin();
        $this->withSession(['charity_admin_id'=>$admin])->post(route('admin.operations.store','gallery'), [
            'title'=>'Community Day','caption'=>'Approved caption','alt_text'=>'People meeting outdoors',
            'category'=>'Community','image_path'=>UploadedFile::fake()->image('community.jpg'),
            'status'=>'published','sort_order'=>0,
        ])->assertRedirect(route('admin.operations.index','gallery'));

        $this->assertDatabaseHas('gallery_items', ['title'=>'Community Day','status'=>'published']);
        $this->assertDatabaseHas('admin_activity_logs', ['admin_id'=>$admin,'action'=>'gallery.created']);
    }

    public function test_paid_donation_receipt_is_only_available_after_payment_confirmation(): void
    {
        $id = DB::table('donations')->insertGetId([
            'donor_name'=>'Receipt Test','amount'=>10000,'currency'=>'UGX','payment_method'=>'Bank transfer',
            'payment_status'=>'pending','donation_date'=>now()->toDateString(),'created_at'=>now(),'updated_at'=>now(),
        ]);
        $admin = $this->admin('finance_manager');
        $this->withSession(['charity_admin_id'=>$admin])->get(route('admin.donations.receipt',$id))->assertNotFound();
        DB::table('donations')->where('id',$id)->update(['payment_status'=>'paid','receipt_number'=>'MRF-TEST-000001']);
        $this->withSession(['charity_admin_id'=>$admin])->get(route('admin.donations.receipt',$id))->assertOk()->assertSee('MRF-TEST-000001');
    }
}

<?php

namespace Tests\Feature;

use App\Models\SitePageContent;
use Database\Seeders\SitePageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SitePageContentManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SitePageContentSeeder::class);
    }

    private function admin(string $role = 'content_manager', bool $active = true): int
    {
        return DB::table('admins')->insertGetId([
            'name' => 'Page Editor', 'email' => uniqid('page-', true).'@example.test',
            'password' => bcrypt('test-password'), 'role' => $role, 'is_active' => $active,
            'last_login_at' => null, 'created_at' => now(), 'updated_at' => now(),
        ]);
    }

    public function test_all_five_public_pages_render_seeded_content_and_forms(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('Compassion in action. Hope in community.')->assertSee('Food &amp; Essential Support', false);
        $this->get(route('impact'))->assertOk()->assertSee('Make the impact visible. Keep the evidence honest.');
        $this->get(route('stories'))->assertOk()->assertSee('Stories from people and communities.');
        $this->get(route('contact'))->assertOk()->assertSee('Let’s start a conversation.')->assertSee(route('contact.submit'));
        $this->get(route('get-involved'))->assertOk()->assertSee('Be part of practical community support.')->assertSee(route('volunteer.submit'))->assertSee(route('donate.submit'));
    }

    public function test_page_editor_requires_an_active_content_authorised_admin(): void
    {
        $this->get(route('admin.site-pages.index'))->assertForbidden();
        $finance = $this->admin('finance_manager');
        $this->withSession(['charity_admin_id' => $finance])->get(route('admin.site-pages.edit', 'home'))->assertForbidden();
        $inactive = $this->admin('administrator', false);
        $this->withSession(['charity_admin_id' => $inactive])->get(route('admin.site-pages.index'))->assertForbidden();
    }

    public function test_content_manager_can_edit_a_page_and_save_section_items_with_audit_log(): void
    {
        $admin = $this->admin();
        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.site-pages.edit', 'home'))
            ->assertOk()->assertSee('Edit Home page')->assertSee('Section information');

        $page = SitePageContent::where('page_key', 'home')->firstOrFail();
        $sections = $page->sections;
        $sections[0]['title'] = 'A newly updated values section';
        $sections[0]['items'] = [['title' => 'Care', 'description' => 'Support with dignity.']];

        $payload = [
            'hero_eyebrow' => 'Welcome',
            'hero_heading' => 'A new public homepage heading',
            'hero_intro' => 'Updated homepage introduction for visitors.',
            'hero_image_path' => 'assets/images/hero-community.webp',
            'sections' => [],
        ];
        foreach ($sections as $section) {
            $payload['sections'][] = [
                'eyebrow' => $section['eyebrow'] ?? '',
                'title' => $section['title'],
                'body' => $section['body'],
                'image_path' => $section['image_path'] ?? '',
                'items_text' => collect($section['items'] ?? [])->map(fn ($item) => $item['title'].' | '.$item['description'])->implode("\n"),
            ];
        }

        $this->withSession(['charity_admin_id' => $admin])
            ->put(route('admin.site-pages.update', 'home'), $payload)
            ->assertRedirect(route('admin.site-pages.edit', 'home'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('site_page_contents', ['page_key' => 'home', 'hero_heading' => 'A new public homepage heading']);
        $this->get(route('home'))->assertOk()->assertSee('A new public homepage heading')->assertSee('A newly updated values section');
        $this->assertDatabaseHas('admin_activity_logs', [
            'admin_id' => $admin, 'action' => 'site_page.home.updated', 'subject_type' => 'site_page_content',
        ]);
    }


    public function test_website_pages_is_directly_discoverable_and_sidebar_is_consistent_across_admin_sections(): void
    {
        $admin = $this->admin('content_manager');

        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.site-pages.index'))
            ->assertOk()
            ->assertSee('Every page, one place.')
            ->assertSee('Choose a page to edit')
            ->assertSee('Home')
            ->assertSee('Impact')
            ->assertSee('Stories')
            ->assertSee('Contact')
            ->assertSee('Get involved')
            ->assertSee(route('admin.site-pages.edit', 'home'))
            ->assertSee('class="sidebar"', false);

        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.about.edit'))
            ->assertOk()
            ->assertSee(route('admin.site-pages.index'))
            ->assertSee('Website pages')
            ->assertSee('Programs');

        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.programs.index'))
            ->assertOk()
            ->assertSee(route('admin.site-pages.index'))
            ->assertSee('About page')
            ->assertSee('Website pages');

        $this->withSession(['charity_admin_id' => $admin])
            ->get(route('admin.operations.index', 'stories'))
            ->assertOk()
            ->assertSee(route('admin.site-pages.index'))
            ->assertSee('Website pages')
            ->assertSee('Foundation operations');
    }

    public function test_malformed_section_items_are_rejected(): void
    {
        $admin = $this->admin();
        $page = SitePageContent::where('page_key', 'contact')->firstOrFail();
        $sections = [];
        foreach ($page->sections as $section) {
            $sections[] = [
                'eyebrow' => $section['eyebrow'] ?? '', 'title' => $section['title'], 'body' => $section['body'],
                'image_path' => $section['image_path'] ?? '', 'items_text' => '',
            ];
        }
        $sections[0]['items_text'] = 'Missing separator';
        $this->withSession(['charity_admin_id' => $admin])
            ->from(route('admin.site-pages.edit', 'contact'))
            ->put(route('admin.site-pages.update', 'contact'), [
                'hero_heading' => 'Contact heading', 'hero_intro' => 'Contact intro', 'sections' => $sections,
            ])
            ->assertStatus(422);
    }
}

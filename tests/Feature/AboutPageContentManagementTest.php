<?php

namespace Tests\Feature;

use App\Models\AboutPageContent;
use Database\Seeders\AboutPageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AboutPageContentManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(AboutPageContentSeeder::class);
    }

    private function admin(string $role = 'content_manager', bool $active = true): int
    {
        $now = now();

        return DB::table('admins')->insertGetId([
            'name' => 'Test About Editor',
            'email' => uniqid('about-', true) . '@example.test',
            'password' => bcrypt('test-password'),
            'role' => $role,
            'is_active' => $active,
            'last_login_at' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function test_about_editor_rejects_requests_without_admin_session(): void
    {
        $this->get(route('admin.about.edit'))->assertForbidden();
    }

    public function test_finance_role_cannot_edit_about_page(): void
    {
        $adminId = $this->admin('finance_manager');

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.about.edit'))
            ->assertForbidden();
    }

    public function test_content_manager_can_open_editor_and_save_about_content(): void
    {
        $adminId = $this->admin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.about.edit'))
            ->assertOk()
            ->assertSee('About page editor');

        $this->withSession(['charity_admin_id' => $adminId])
            ->put(route('admin.about.update'), [
                'hero_eyebrow' => 'Who we are',
                'hero_heading' => 'Together, we can support our communities.',
                'hero_intro' => 'A verified introduction to the foundation.',
                'intro_heading' => 'A community-centered foundation.',
                'intro_body' => 'We work with dignity and care.',
                'intro_supporting' => 'More confirmed information will be added.',
                'mission' => 'Support people with dignity.',
                'vision' => 'Communities with greater opportunity.',
                'values_text' => "Compassion | Respond with care.\nIntegrity | Act honestly.",
                'approach_heading' => 'Listen and learn.',
                'approach_intro' => 'Our approach starts with people.',
                'steps_text' => "Listen | Hear community priorities.\nAct | Coordinate practical support.",
                'hero_image_path' => 'assets/images/hero-community.webp',
                'intro_image_path' => 'assets/images/project.webp',
            ])
            ->assertRedirect(route('admin.about.edit'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('about_page_contents', [
            'id' => 1,
            'hero_heading' => 'Together, we can support our communities.',
        ]);

        $content = AboutPageContent::findOrFail(1);
        $this->assertSame([
            ['title' => 'Compassion', 'description' => 'Respond with care.'],
            ['title' => 'Integrity', 'description' => 'Act honestly.'],
        ], $content->values);

        $this->assertSame([
            ['title' => 'Listen', 'description' => 'Hear community priorities.'],
            ['title' => 'Act', 'description' => 'Coordinate practical support.'],
        ], $content->approach_steps);

        $this->assertDatabaseHas('admin_activity_logs', [
            'admin_id' => $adminId,
            'action' => 'about_page.updated',
            'subject_type' => 'about_page_content',
            'subject_id' => 1,
        ]);
    }

    public function test_public_about_page_renders_content_from_database(): void
    {
        AboutPageContent::whereKey(1)->update([
            'hero_heading' => 'Database-backed About heading test.',
        ]);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Database-backed About heading test.')
            ->assertSee('Mission')
            ->assertSee('Vision');
    }

    public function test_malformed_values_are_rejected(): void
    {
        $adminId = $this->admin();

        $this->withSession(['charity_admin_id' => $adminId])
            ->from(route('admin.about.edit'))
            ->put(route('admin.about.update'), [
                'hero_eyebrow' => 'About',
                'hero_heading' => 'Heading',
                'hero_intro' => 'Intro',
                'intro_heading' => 'Who we are',
                'intro_body' => 'Body',
                'intro_supporting' => '',
                'mission' => 'Mission',
                'vision' => 'Vision',
                'values_text' => 'Missing separator',
                'approach_heading' => 'Approach',
                'approach_intro' => 'Intro',
                'steps_text' => 'Listen | Hear people.',
                'hero_image_path' => '',
                'intro_image_path' => '',
            ])
            ->assertStatus(422);
    }
}

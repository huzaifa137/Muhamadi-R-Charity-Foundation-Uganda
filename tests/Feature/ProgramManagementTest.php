<?php

namespace Tests\Feature;

use App\Models\Program;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProgramManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(string $role = 'content_manager', bool $active = true): int
    {
        $now = now();

        return DB::table('admins')->insertGetId([
            'name' => 'Test Content Editor',
            'email' => uniqid('content-', true) . '@example.test',
            'password' => bcrypt('test-password'),
            'role' => $role,
            'is_active' => $active,
            'last_login_at' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function test_program_management_rejects_requests_without_an_admin_session(): void
    {
        $this->get(route('admin.programs.index'))->assertForbidden();
    }

    public function test_finance_role_cannot_manage_program_content(): void
    {
        $adminId = $this->admin('finance_manager');

        $this->withSession(['charity_admin_id' => $adminId])
            ->get(route('admin.programs.index'))
            ->assertForbidden();
    }

    public function test_content_manager_can_create_a_published_program_and_action_is_logged(): void
    {
        $adminId = $this->admin('content_manager');

        $this->withSession(['charity_admin_id' => $adminId])
            ->post(route('admin.programs.store'), [
                'title' => 'School Support Initiative',
                'slug' => '',
                'category' => 'Education',
                'summary' => 'Practical support for learners and families.',
                'description' => 'The program works with communities to understand support needs.',
                'image_path' => 'assets/images/community-support.webp',
                'objectives_text' => "Listen to families.\nCoordinate support.",
                'status' => 'published',
                'sort_order' => 5,
            ])
            ->assertRedirect(route('admin.programs.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('programs', [
            'slug' => 'school-support-initiative',
            'status' => 'published',
            'sort_order' => 5,
        ]);

        $program = Program::where('slug', 'school-support-initiative')->firstOrFail();
        $this->assertSame(['Listen to families.', 'Coordinate support.'], $program->objectives);

        $this->assertDatabaseHas('admin_activity_logs', [
            'admin_id' => $adminId,
            'action' => 'program.created',
            'subject_type' => 'program',
            'subject_id' => $program->id,
        ]);
    }

    public function test_public_programs_page_shows_published_programs_but_hides_drafts(): void
    {
        Program::create([
            'title' => 'Published Community Outreach',
            'slug' => 'published-outreach-test',
            'summary' => 'Visible public summary.',
            'description' => 'Visible public description.',
            'status' => 'published',
            'published_at' => now(),
            'sort_order' => 1,
        ]);

        Program::create([
            'title' => 'Internal Draft Program',
            'slug' => 'internal-draft-test',
            'summary' => 'This should not be public.',
            'description' => 'Draft description.',
            'status' => 'draft',
            'sort_order' => 2,
        ]);

        $this->get(route('programs'))
            ->assertOk()
            ->assertSee('Published Community Outreach')
            ->assertDontSee('Internal Draft Program');
    }

    public function test_content_manager_can_change_a_published_program_to_draft(): void
    {
        $adminId = $this->admin();
        $program = Program::create([
            'title' => 'Temporary Program',
            'slug' => 'temporary-program',
            'summary' => 'A short summary.',
            'description' => 'Program details.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->withSession(['charity_admin_id' => $adminId])
            ->put(route('admin.programs.update', $program), [
                'title' => $program->title,
                'slug' => $program->slug,
                'category' => '',
                'summary' => $program->summary,
                'description' => $program->description,
                'image_path' => '',
                'objectives_text' => '',
                'status' => 'draft',
                'sort_order' => 0,
            ])
            ->assertRedirect(route('admin.programs.index'));

        $this->assertDatabaseHas('programs', ['id' => $program->id, 'status' => 'draft', 'published_at' => null]);
    }
}

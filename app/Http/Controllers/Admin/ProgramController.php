<?php

namespace App\\Http\\Controllers\\Admin;

use App\\Http\\Controllers\\Controller;
use App\\Models\\Program;
use Illuminate\\Http\\RedirectResponse;
use Illuminate\\Http\\Request;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Str;
use Illuminate\\Validation\\Rule;
use Illuminate\\View\\View;

class ProgramController extends Controller
{
    private function currentAdmin(): object
    {
        $admin = DB::table('admins')
            ->where('id', session('charity_admin_id'))
            ->where('is_active', true)
            ->first();

        abort_unless($admin, 403, 'An active administrator sign-in is required.');
        abort_unless(in_array($admin->role, ['super_admin', 'administrator', 'content_manager'], true), 403, 'Your role cannot manage website content.');

        return $admin;
    }

    private function log(object $admin, string $action, Program $program): void
    {
        DB::table('admin_activity_logs')->insert([
            'admin_id' => $admin->id,
            'action' => $action,
            'subject_type' => 'program',
            'subject_id' => $program->id,
            'details' => json_encode(['title' => $program->title, 'status' => $program->status]),
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function index(): View
    {
        $this->currentAdmin();

        return view('admin.programs.index', [
            'programs' => Program::query()->orderBy('sort_order')->orderBy('title')->paginate(12),
            'publishedCount' => Program::query()->where('status', 'published')->count(),
            'draftCount' => Program::query()->where('status', 'draft')->count(),
        ]);
    }

    public function create(): View
    {
        $this->currentAdmin();
        return view('admin.programs.form', ['program' => new Program()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $admin = $this->currentAdmin();
        $data = $this->validatedData($request);
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['objectives'] = $this->objectivesFromInput($data['objectives_text'] ?? '');
        unset($data['objectives_text']);
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        $program = Program::create($data);
        $this->log($admin, 'program.created', $program);

        return redirect()->route('admin.programs.index')->with('status', 'Program created successfully.');
    }

    public function edit(Program $program): View
    {
        $this->currentAdmin();
        return view('admin.programs.form', ['program' => $program]);
    }

    public function update(Request $request, Program $program): RedirectResponse
    {
        $admin = $this->currentAdmin();
        $data = $this->validatedData($request, $program);
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['objectives'] = $this->objectivesFromInput($data['objectives_text'] ?? '');
        unset($data['objectives_text']);
        $data['published_at'] = $data['status'] === 'published'
            ? ($program->published_at ?? now())
            : null;

        $program->update($data);
        $this->log($admin, 'program.updated', $program);

        return redirect()->route('admin.programs.index')->with('status', 'Program changes saved.');
    }

    public function destroy(Program $program): RedirectResponse
    {
        $admin = $this->currentAdmin();
        $this->log($admin, 'program.deleted', $program);
        $program->delete();

        return redirect()->route('admin.programs.index')->with('status', 'Program deleted.');
    }

    private function validatedData(Request $request, ?Program $program = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'regex:/^[a-zA-Z0-9\\s_-]*$/', Rule::unique('programs', 'slug')->ignore($program?->id)],
            'category' => ['nullable', 'string', 'max:100'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string', 'max:10000'],
            'image_path' => ['nullable', 'string', 'max:500'],
            'objectives_text' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);
    }

    private function objectivesFromInput(string $text): array
    {
        return collect(preg_split('/\\r\\n|\\r|\\n/', $text) ?: [])
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->take(30)
            ->values()
            ->all();
    }
}

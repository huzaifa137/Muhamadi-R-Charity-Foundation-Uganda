<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AboutPageController extends Controller
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

    public function edit(): View
    {
        $this->currentAdmin();
        $content = AboutPageContent::firstOrFail();

        return view('admin.about.edit', [
            'content' => $content,
            'valuesText' => collect($content->values ?? [])->map(fn ($item) => ($item['title'] ?? '') . ' | ' . ($item['description'] ?? ''))->implode("\n"),
            'stepsText' => collect($content->approach_steps ?? [])->map(fn ($item) => ($item['title'] ?? '') . ' | ' . ($item['description'] ?? ''))->implode("\n"),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $admin = $this->currentAdmin();
        $data = $request->validate([
            'hero_eyebrow' => ['required', 'string', 'max:120'],
            'hero_heading' => ['required', 'string', 'max:220'],
            'hero_intro' => ['required', 'string', 'max:3000'],
            'intro_heading' => ['required', 'string', 'max:220'],
            'intro_body' => ['required', 'string', 'max:5000'],
            'intro_supporting' => ['nullable', 'string', 'max:5000'],
            'mission' => ['required', 'string', 'max:5000'],
            'vision' => ['required', 'string', 'max:5000'],
            'values_text' => ['required', 'string', 'max:6000'],
            'approach_heading' => ['required', 'string', 'max:220'],
            'approach_intro' => ['required', 'string', 'max:3000'],
            'steps_text' => ['required', 'string', 'max:6000'],
            'hero_image_path' => ['nullable', 'string', 'max:500'],
            'intro_image_path' => ['nullable', 'string', 'max:500'],
        ]);

        $data['values'] = $this->parseLines($data['values_text'], 'Values');
        $data['approach_steps'] = $this->parseLines($data['steps_text'], 'Approach steps');
        unset($data['values_text'], $data['steps_text']);

        $content = AboutPageContent::firstOrFail();
        $content->update($data);

        DB::table('admin_activity_logs')->insert([
            'admin_id' => $admin->id,
            'action' => 'about_page.updated',
            'subject_type' => 'about_page_content',
            'subject_id' => $content->id,
            'details' => json_encode(['heading' => $content->hero_heading]),
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.about.edit')->with('status', 'About page content saved and published.');
    }

    private function parseLines(string $text, string $label): array
    {
        $lines = collect(preg_split('/\r\n|\r|\n/', $text) ?: [])
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values();

        abort_if($lines->isEmpty(), 422, $label . ' must contain at least one entry.');
        abort_if($lines->count() > 12, 422, $label . ' can contain at most 12 entries.');

        return $lines->map(function (string $line) use ($label) {
            $parts = array_map('trim', explode('|', $line, 2));
            abort_if(count($parts) !== 2 || $parts[0] === '' || $parts[1] === '', 422, $label . ' must use the format: Title | Description.');

            return ['title' => $parts[0], 'description' => $parts[1]];
        })->all();
    }
}

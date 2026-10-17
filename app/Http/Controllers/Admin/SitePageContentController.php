<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitePageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SitePageContentController extends Controller
{
    private const PAGE_KEYS = ['home', 'impact', 'stories', 'contact', 'get-involved'];

    private function currentAdmin(): object
    {
        $admin = DB::table('admins')->where('id', session('charity_admin_id'))->where('is_active', true)->first();
        abort_unless($admin, 403, 'An active administrator sign-in is required.');
        abort_unless(in_array($admin->role, ['super_admin', 'administrator', 'content_manager'], true), 403, 'Your role cannot manage website content.');
        return $admin;
    }

    public function index(): View
    {
        $this->currentAdmin();
        $pages = SitePageContent::whereIn('page_key', self::PAGE_KEYS)->orderBy('id')->get();
        return view('admin.site-pages.index', compact('pages'));
    }

    public function edit(string $page): View
    {
        $this->currentAdmin();
        abort_unless(in_array($page, self::PAGE_KEYS, true), 404);
        $content = SitePageContent::where('page_key', $page)->firstOrFail();
        return view('admin.site-pages.edit', compact('content'));
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        $admin = $this->currentAdmin();
        abort_unless(in_array($page, self::PAGE_KEYS, true), 404);
        $content = SitePageContent::where('page_key', $page)->firstOrFail();
        $data = $request->validate([
            'hero_eyebrow' => ['nullable', 'string', 'max:180'],
            'hero_heading' => ['required', 'string', 'max:240'],
            'hero_intro' => ['required', 'string', 'max:5000'],
            'hero_image_path' => ['nullable', 'string', 'max:500'],
            'sections' => ['required', 'array', 'min:1', 'max:12'],
            'sections.*.eyebrow' => ['nullable', 'string', 'max:180'],
            'sections.*.title' => ['required', 'string', 'max:240'],
            'sections.*.body' => ['required', 'string', 'max:5000'],
            'sections.*.image_path' => ['nullable', 'string', 'max:500'],
            'sections.*.items_text' => ['nullable', 'string', 'max:12000'],
            'sections.*.items_text' => ['nullable', 'string', 'max:12000'],
        ]);

        $sections = [];
        foreach ($data['sections'] as $index => $section) {
            $items = [];
            foreach (preg_split('/\r\n|\r|\n/', $section['items_text'] ?? '') ?: [] as $line) {
                $line = trim($line);
                if ($line === '') continue;
                $parts = array_map('trim', explode('|', $line, 2));
                abort_if(count($parts) !== 2 || $parts[0] === '' || $parts[1] === '', 422, 'Section items must use the format: Title | Description.');
                $items[] = ['title' => $parts[0], 'description' => $parts[1]];
            }
            abort_if(count($items) > 20, 422, 'Each section can contain at most 20 items.');
            $sections[] = [
                'eyebrow' => $section['eyebrow'] ?? '',
                'title' => $section['title'],
                'body' => $section['body'],
                'image_path' => $section['image_path'] ?? '',
                'items' => $items,
            ];
        }

        $content->update([
            'hero_eyebrow' => $data['hero_eyebrow'] ?? '',
            'hero_heading' => $data['hero_heading'],
            'hero_intro' => $data['hero_intro'],
            'hero_image_path' => $data['hero_image_path'] ?? '',
            'sections' => $sections,
        ]);

        DB::table('admin_activity_logs')->insert([
            'admin_id' => $admin->id,
            'action' => 'site_page.'.$page.'.updated',
            'subject_type' => 'site_page_content',
            'subject_id' => $content->id,
            'details' => json_encode(['page_key' => $page, 'heading' => $content->hero_heading]),
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.site-pages.edit', $page)->with('status', $content->page_title.' content saved and published.');
    }

    public function publicContent(string $page): SitePageContent
    {
        abort_unless(in_array($page, self::PAGE_KEYS, true), 404);
        return SitePageContent::where('page_key', $page)->firstOrFail();
    }
}

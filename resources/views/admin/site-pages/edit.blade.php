<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Edit {{ $content->page_title }} | Admin Console</title>
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.sp-wrap{max-width:1180px}.sp-grid{display:grid;grid-template-columns:minmax(0,1fr) 290px;gap:20px;align-items:start}.sp-stack{display:grid;gap:18px}.sp-card{padding:22px}.sp-field{display:grid;gap:7px;margin-bottom:16px}.sp-field label{font-size:.78rem;font-weight:800}.sp-field small,.sp-note{font-size:.74rem;color:var(--muted);line-height:1.65}.sp-field input,.sp-field textarea{width:100%;min-width:0;padding:11px 12px;border:1px solid var(--line);border-radius:10px;background:#fff;color:var(--ink);font:inherit;font-size:.82rem}.sp-field textarea{min-height:100px;resize:vertical;line-height:1.65}.sp-alert{padding:12px 15px;border-radius:10px;margin-bottom:16px;background:#eefaf0;border:1px solid #cfe8d4;color:#245a36}.sp-errors{padding:12px 15px;border-radius:10px;margin-bottom:16px;background:#fff4f4;border:1px solid #efc7c7;color:#922b2b}.sp-section-title{margin:0 0 16px;padding-bottom:10px;border-bottom:1px solid var(--line)}.sp-actions{display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;margin-top:18px}.sp-preview{width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:10px;background:#eef1ed}
@media(max-width:850px){.sp-grid{grid-template-columns:1fr}}
@media(max-width:560px){.sp-card{padding:16px}}
</style>
</head>
<body>
<div class="app">
@include('admin.partials.sidebar')
<div class="main">
<header class="topbar">
    <button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button>
    <div><b>{{ $content->page_title }} editor</b><div class="xs muted">Hero copy and page sections</div></div>
    <div class="top-actions">
        <a class="btn btn-outline btn-sm" href="{{ route('admin.site-pages.index') }}">All website pages</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-outline btn-sm" type="submit">Sign out</button>
        </form>
    </div>
</header>
<main class="content sp-wrap">
    <div class="page-head">
        <div class="crumb">Content management / Website pages / {{ $content->page_title }}</div>
        <h1>Edit {{ $content->page_title }}</h1>
        <p>Update wording and section details while keeping the site's existing image assets and public forms available.</p>
    </div>
    @if(session('status'))
        <div class="sp-alert" role="status">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="sp-errors" role="alert">
            <b>Please correct the following:</b>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.site-pages.update', $content->page_key) }}">
        @csrf
        @method('PUT')
        <div class="sp-grid">
            <div class="sp-stack">
                <section class="card sp-card">
                    <h2 class="sp-section-title">Hero section</h2>
                    <div class="sp-field">
                        <label for="hero_eyebrow">Small label</label>
                        <input id="hero_eyebrow" name="hero_eyebrow" maxlength="180" value="{{ old('hero_eyebrow', $content->hero_eyebrow) }}">
                    </div>
                    <div class="sp-field">
                        <label for="hero_heading">Main heading *</label>
                        <textarea id="hero_heading" name="hero_heading" maxlength="240" required>{{ old('hero_heading', $content->hero_heading) }}</textarea>
                    </div>
                    <div class="sp-field">
                        <label for="hero_intro">Introduction *</label>
                        <textarea id="hero_intro" name="hero_intro" maxlength="5000" required>{{ old('hero_intro', $content->hero_intro) }}</textarea>
                    </div>
                </section>
                @foreach($content->sections as $index => $section)
                    <section class="card sp-card">
                        <h2 class="sp-section-title">Section {{ $index + 1 }}: {{ $section['title'] ?? 'Page section' }}</h2>
                        <div class="sp-field">
                            <label for="section_{{ $index }}_eyebrow">Section label</label>
                            <input id="section_{{ $index }}_eyebrow" name="sections[{{ $index }}][eyebrow]" maxlength="180" value="{{ old('sections.'.$index.'.eyebrow', $section['eyebrow'] ?? '') }}">
                        </div>
                        <div class="sp-field">
                            <label for="section_{{ $index }}_title">Section heading *</label>
                            <textarea id="section_{{ $index }}_title" name="sections[{{ $index }}][title]" maxlength="240" required>{{ old('sections.'.$index.'.title', $section['title'] ?? '') }}</textarea>
                        </div>
                        <div class="sp-field">
                            <label for="section_{{ $index }}_body">Section information *</label>
                            <textarea id="section_{{ $index }}_body" name="sections[{{ $index }}][body]" maxlength="5000" required>{{ old('sections.'.$index.'.body', $section['body'] ?? '') }}</textarea>
                        </div>
                        <div class="sp-field">
                            <label for="section_{{ $index }}_items">Section items (one per line)</label>
                            <textarea id="section_{{ $index }}_items" name="sections[{{ $index }}][items_text]" maxlength="12000">{{ old('sections.'.$index.'.items_text', collect($section['items'] ?? [])->map(fn($item) => ($item['title'] ?? '').' | '.($item['description'] ?? ''))->implode("\n")) }}</textarea>
                            <small>Use <b>Title | Description</b> for each item. Leave blank if this section has no list.</small>
                        </div>
                        <div class="sp-field">
                            <label for="section_{{ $index }}_image">Image path</label>
                            <input id="section_{{ $index }}_image" name="sections[{{ $index }}][image_path]" maxlength="500" value="{{ old('sections.'.$index.'.image_path', $section['image_path'] ?? '') }}">
                            <small>Use an existing path relative to the public folder, for example assets/images/community-group.webp.</small>
                        </div>
                    </section>
                @endforeach
            </div>
            <aside class="sp-stack">
                <section class="card sp-card">
                    <h2 class="sp-section-title">Hero image</h2>
                    <div class="sp-field">
                        <label for="hero_image_path">Image path</label>
                        <input id="hero_image_path" name="hero_image_path" maxlength="500" value="{{ old('hero_image_path', $content->hero_image_path) }}" placeholder="assets/images/hero-community.webp">
                    </div>
                    @if($content->hero_image_path)
                        <img class="sp-preview" src="{{ asset($content->hero_image_path) }}" alt="Current hero image">
                    @endif
                    <p class="sp-note">Image paths should point to existing public assets. This editor changes content and paths; it does not upload new images.</p>
                </section>
                <section class="card sp-card">
                    <h2 class="sp-section-title">Before publishing</h2>
                    <p class="sp-note">Keep impact figures, dates, locations, partnerships and official claims accurate and approved. Do not add unverified statistics.</p>
                    <p class="sp-note">Existing donation, volunteer and contact forms remain separate from page copy and continue to submit to the application.</p>
                    <a class="btn btn-outline" style="margin-top:10px" href="{{ route($content->page_key === 'home' ? 'home' : ($content->page_key === 'get-involved' ? 'get-involved' : $content->page_key)) }}" target="_blank" rel="noopener">Open public page ↗</a>
                </section>
            </aside>
        </div>
        <div class="sp-actions">
            <a class="btn btn-outline" href="{{ route('admin.site-pages.index') }}">Cancel</a>
            <button class="btn btn-primary" type="submit">Save and publish</button>
        </div>
    </form>
    <footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Page editor</footer>
</main>
</div>
</div>
<script src="{{ asset('admin-static/js/admin.js') }}" defer></script>
</body>
</html>

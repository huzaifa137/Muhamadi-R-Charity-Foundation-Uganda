<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Edit {{ $content->page_title }} | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.spe-wrap{max-width:1440px}.spe-hero{position:relative;isolation:isolate;overflow:hidden;display:flex;align-items:flex-start;justify-content:space-between;gap:24px;padding:30px 32px;margin-bottom:22px;border-radius:20px;background:linear-gradient(120deg,#102e27 0%,#1b5b42 62%,#267653 100%);color:#fff;box-shadow:0 16px 34px rgba(19,65,46,.12)}.spe-hero:after{content:"";position:absolute;z-index:-1;width:270px;height:270px;right:7%;top:-150px;border:1px solid rgba(255,255,255,.16);border-radius:50%;box-shadow:0 0 0 32px rgba(255,255,255,.035),0 0 0 68px rgba(255,255,255,.025)}.spe-hero-copy{max-width:760px}.spe-kicker{display:inline-flex;align-items:center;gap:8px;color:#c5e8d1;font-size:.68rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase}.spe-kicker:before{content:"";width:22px;height:2px;background:#c5e8d1}.spe-hero h1{margin:11px 0 10px;color:#fff;font-size:clamp(1.75rem,3vw,2.45rem);line-height:1.13;letter-spacing:-.045em}.spe-hero p{max-width:670px;margin:0;color:rgba(255,255,255,.79);font-size:.86rem;line-height:1.8}.spe-hero-actions{position:relative;z-index:1;display:flex;gap:9px;flex-wrap:wrap}.spe-hero .btn-outline{border-color:rgba(255,255,255,.34);background:rgba(255,255,255,.07);color:#fff}.spe-breadcrumb{margin-bottom:9px;color:#c5e8d1;font-size:.72rem;font-weight:700}.spe-overview{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:13px;margin-bottom:24px}.spe-stat{display:flex;align-items:center;gap:13px;padding:16px 18px;border:1px solid var(--line);border-radius:15px;background:#fff;box-shadow:0 5px 16px rgba(20,40,28,.025)}.spe-stat-icon{display:grid;place-items:center;flex:0 0 42px;width:42px;height:42px;border-radius:13px;background:#edf6ef;color:#246b43;font-size:1.05rem;font-weight:800}.spe-stat strong{display:block;font-size:.94rem;line-height:1.4}.spe-stat span{display:block;color:var(--muted);font-size:.7rem;line-height:1.5}.spe-alert,.spe-errors{padding:13px 16px;border-radius:12px;margin-bottom:17px;font-size:.81rem}.spe-alert{background:#eefaf0;border:1px solid #cfe8d4;color:#245a36}.spe-errors{background:#fff4f4;border:1px solid #efc7c7;color:#922b2b}.spe-errors ul{margin:8px 0 0;padding-left:20px}.spe-layout{display:grid;grid-template-columns:minmax(0,1fr) 300px;gap:20px;align-items:start}.spe-stack{display:grid;gap:18px;min-width:0}.spe-card{padding:23px;border:1px solid var(--line);border-radius:17px;background:#fff;box-shadow:0 5px 18px rgba(20,40,28,.025)}.spe-card-head{display:flex;align-items:flex-start;gap:13px;margin-bottom:20px;padding-bottom:15px;border-bottom:1px solid var(--line)}.spe-card-number{display:grid;place-items:center;flex:0 0 38px;width:38px;height:38px;border-radius:12px;background:#edf6ef;color:#246b43;font-size:.8rem;font-weight:800}.spe-card-head h2{margin:1px 0 5px;font-size:1rem;letter-spacing:-.025em}.spe-card-head p{margin:0;color:var(--muted);font-size:.73rem;line-height:1.6}.spe-field{display:grid;gap:7px;margin-bottom:17px;min-width:0}.spe-field:last-child{margin-bottom:0}.spe-field label{font-size:.76rem;font-weight:800;color:var(--ink)}.spe-required{color:#b44444}.spe-field input,.spe-field textarea{box-sizing:border-box;width:100%;min-width:0;padding:12px 13px;border:1px solid var(--line);border-radius:10px;background:#fff;color:var(--ink);font:inherit;font-size:.81rem;line-height:1.65;transition:border-color .15s,box-shadow .15s}.spe-field input:focus,.spe-field textarea:focus{outline:none;border-color:#4c8b68;box-shadow:0 0 0 3px rgba(43,119,76,.1)}.spe-field textarea{min-height:112px;resize:vertical}.spe-field small{font-size:.71rem;color:var(--muted);line-height:1.65}.spe-field small b{color:#405c48}.spe-two{display:grid;grid-template-columns:1fr 1fr;gap:14px}.spe-preview{display:block;width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:12px;background:#eef1ed;border:1px solid var(--line);margin-top:14px}.spe-note{color:var(--muted);font-size:.75rem;line-height:1.75}.spe-note strong{color:var(--ink)}.spe-side-card{position:sticky;top:18px}.spe-checklist{display:grid;gap:12px;margin:15px 0 0;padding:0;list-style:none}.spe-checklist li{display:flex;align-items:flex-start;gap:9px;color:var(--muted);font-size:.73rem;line-height:1.65}.spe-check{display:grid;place-items:center;flex:0 0 22px;width:22px;height:22px;border-radius:7px;background:#edf6ef;color:#246b43;font-size:.72rem;font-weight:800}.spe-actions{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:18px 0 0}.spe-actions-right{display:flex;gap:9px;flex-wrap:wrap}.spe-publish{display:flex;gap:12px;align-items:flex-start;padding:14px 15px;border:1px solid #dce9de;border-radius:12px;background:#f5faf5;color:#526557;font-size:.73rem;line-height:1.7}.spe-publish-icon{display:grid;place-items:center;flex:0 0 27px;width:27px;height:27px;border-radius:9px;background:#e3f1e5;color:#256a43;font-weight:900}.spe-section-label{display:inline-flex;align-items:center;padding:5px 8px;margin-bottom:10px;border-radius:7px;background:#f1f6f1;color:#42664c;font-size:.62rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase}
@media(max-width:980px){.spe-layout{grid-template-columns:minmax(0,1fr) 260px}.spe-hero{flex-direction:column}.spe-side-card{position:static}}
@media(max-width:760px){.spe-layout{grid-template-columns:1fr}.spe-overview{grid-template-columns:1fr}.spe-side{order:-1}.spe-side-card{position:static}.spe-hero{padding:25px 21px}.spe-card{padding:18px}}
@media(max-width:560px){.spe-two{grid-template-columns:1fr}.spe-actions{align-items:stretch;flex-direction:column}.spe-actions .btn{justify-content:center}.spe-actions-right{width:100%}.spe-actions-right .btn{flex:1}.spe-hero-actions{width:100%}}
</style>
</head>
<body>
<div class="app">
@include('admin.partials.sidebar')
<div class="main">
<header class="topbar">
    <button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button>
    <div><b>Website page editor</b><div class="xs muted">Content management workspace</div></div>
    <div class="top-actions">
        <a class="btn btn-outline btn-sm" href="{{ route('admin.site-pages.index') }}">All website pages</a>
        <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-outline btn-sm" type="submit">Sign out</button></form>
    </div>
</header>
<main class="content spe-wrap">
    <section class="spe-hero">
        <div class="spe-hero-copy">
            <div class="spe-breadcrumb">Content management / Website pages / {{ $content->page_title }}</div>
            <div class="spe-kicker">Website content studio</div>
            <h1>Edit {{ $content->page_title }}</h1>
            <p>Refine the page message and its sections in one place. Your existing public page design, image assets and connected forms remain intact; this workspace updates the content displayed within them.</p>
        </div>
        <div class="spe-hero-actions">
            <a class="btn btn-outline" href="{{ route($content->page_key === 'home' ? 'home' : ($content->page_key === 'get-involved' ? 'get-involved' : $content->page_key)) }}" target="_blank" rel="noopener">Preview public page ↗</a>
        </div>
    </section>

    @if(session('status'))
        <div class="spe-alert" role="status"><strong>Saved successfully.</strong> {{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="spe-errors" role="alert"><strong>Please review the highlighted content and correct the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <section class="spe-overview" aria-label="Page editor overview">
        <div class="spe-stat"><div class="spe-stat-icon">✎</div><div><strong>Content editor</strong><span>Hero copy and section details</span></div></div>
        <div class="spe-stat"><div class="spe-stat-icon">▤</div><div><strong>{{ count($content->sections ?? []) }} content sections</strong><span>Update each section independently</span></div></div>
        <div class="spe-stat"><div class="spe-stat-icon">↗</div><div><strong>Save to publish</strong><span>Changes appear on the public page</span></div></div>
    </section>

    <form method="POST" action="{{ route('admin.site-pages.update', $content->page_key) }}">
        @csrf
        @method('PUT')
        <div class="spe-layout">
            <div class="spe-stack">
                <section class="spe-card">
                    <div class="spe-card-head"><div class="spe-card-number">01</div><div><h2>Hero section</h2><p>The first message visitors see when they arrive on this page.</p></div></div>
                    <div class="spe-field">
                        <label for="hero_eyebrow">Small label <span class="spe-required">*</span></label>
                        <input id="hero_eyebrow" name="hero_eyebrow" maxlength="180" value="{{ old('hero_eyebrow', $content->hero_eyebrow) }}" placeholder="A short introductory label">
                        <small>Keep this concise; it appears above the main heading where supported by the page design.</small>
                    </div>
                    <div class="spe-field">
                        <label for="hero_heading">Main heading <span class="spe-required">*</span></label>
                        <textarea id="hero_heading" name="hero_heading" maxlength="240" required>{{ old('hero_heading', $content->hero_heading) }}</textarea>
                        <small>A clear, memorable headline works best. Maximum 240 characters.</small>
                    </div>
                    <div class="spe-field">
                        <label for="hero_intro">Introduction <span class="spe-required">*</span></label>
                        <textarea id="hero_intro" name="hero_intro" maxlength="5000" required>{{ old('hero_intro', $content->hero_intro) }}</textarea>
                        <small>Explain the purpose of this page in visitor-friendly language.</small>
                    </div>
                </section>

                @foreach($content->sections as $index => $section)
                    <section class="spe-card">
                        <div class="spe-card-head"><div class="spe-card-number">{{ str_pad((string) ($index + 2), 2, '0', STR_PAD_LEFT) }}</div><div><h2>{{ $section['title'] ?? 'Page section' }}</h2><p>Section {{ $index + 1 }} · Update the heading, explanation, optional items and image path.</p></div></div>
                        <div class="spe-field">
                            <label for="section_{{ $index }}_eyebrow">Section label</label>
                            <input id="section_{{ $index }}_eyebrow" name="sections[{{ $index }}][eyebrow]" maxlength="180" value="{{ old('sections.'.$index.'.eyebrow', $section['eyebrow'] ?? '') }}" placeholder="Optional section label">
                        </div>
                        <div class="spe-field">
                            <label for="section_{{ $index }}_title">Section heading <span class="spe-required">*</span></label>
                            <textarea id="section_{{ $index }}_title" name="sections[{{ $index }}][title]" maxlength="240" required>{{ old('sections.'.$index.'.title', $section['title'] ?? '') }}</textarea>
                        </div>
                        <div class="spe-field">
                            <label for="section_{{ $index }}_body">Section information <span class="spe-required">*</span></label>
                            <textarea id="section_{{ $index }}_body" name="sections[{{ $index }}][body]" maxlength="5000" required>{{ old('sections.'.$index.'.body', $section['body'] ?? '') }}</textarea>
                        </div>
                        <div class="spe-field">
                            <label for="section_{{ $index }}_items">Section items</label>
                            <textarea id="section_{{ $index }}_items" name="sections[{{ $index }}][items_text]" maxlength="12000" placeholder="Title | Description">{{ old('sections.'.$index.'.items_text', collect($section['items'] ?? [])->map(fn($item) => ($item['title'] ?? '').' | '.($item['description'] ?? ''))->implode("\n")) }}</textarea>
                            <small>Optional. Use <b>Title | Description</b> on each line. Leave blank if the section has no item list.</small>
                        </div>
                        <div class="spe-field">
                            <label for="section_{{ $index }}_image">Section image path</label>
                            <input id="section_{{ $index }}_image" name="sections[{{ $index }}][image_path]" maxlength="500" value="{{ old('sections.'.$index.'.image_path', $section['image_path'] ?? '') }}" placeholder="assets/images/community-group.webp">
                            <small>Enter an existing path relative to the public folder. New image uploads are not part of this editor.</small>
                        </div>
                    </section>
                @endforeach
            </div>

            <aside class="spe-stack spe-side">
                <section class="spe-card">
                    <div class="spe-card-head"><div class="spe-card-number">IMG</div><div><h2>Hero image</h2><p>Manage the asset path used by the public page.</p></div></div>
                    <div class="spe-field">
                        <label for="hero_image_path">Image path</label>
                        <input id="hero_image_path" name="hero_image_path" maxlength="500" value="{{ old('hero_image_path', $content->hero_image_path) }}" placeholder="assets/images/hero-community.webp">
                        <small>Use an existing file under the public folder.</small>
                    </div>
                    @if($content->hero_image_path)
                        <img class="spe-preview" src="{{ asset($content->hero_image_path) }}" alt="Current hero image preview" loading="lazy">
                    @else
                        <div class="spe-publish"><span class="spe-publish-icon">i</span><div>No hero image path is currently set for this page.</div></div>
                    @endif
                </section>

                <section class="spe-card">
                    <div class="spe-card-head"><div class="spe-card-number">✓</div><div><h2>Publishing checklist</h2><p>A quick review before making changes public.</p></div></div>
                    <p class="spe-note">Saving publishes your content immediately. Review the details below before you submit.</p>
                    <ul class="spe-checklist">
                        <li><span class="spe-check">✓</span><span>Keep names, dates, locations and impact claims accurate and approved.</span></li>
                        <li><span class="spe-check">✓</span><span>Use short headings and plain language that is easy for visitors to understand.</span></li>
                        <li><span class="spe-check">✓</span><span>Check image paths carefully; this editor does not upload files.</span></li>
                        <li><span class="spe-check">✓</span><span>Existing donation, volunteer and contact forms remain connected and unchanged.</span></li>
                    </ul>
                    <a class="btn btn-outline" style="margin-top:18px;width:100%;justify-content:center" href="{{ route($content->page_key === 'home' ? 'home' : ($content->page_key === 'get-involved' ? 'get-involved' : $content->page_key)) }}" target="_blank" rel="noopener">Open live page ↗</a>
                </section>
                <div class="spe-publish"><span class="spe-publish-icon">i</span><div><strong>Audit trail enabled</strong><br>Content updates are recorded in the administrator activity log.</div></div>
            </aside>
        </div>

        <div class="spe-actions">
            <a class="btn btn-outline" href="{{ route('admin.site-pages.index') }}">← Back to website pages</a>
            <div class="spe-actions-right"><a class="btn btn-outline" href="{{ route($content->page_key === 'home' ? 'home' : ($content->page_key === 'get-involved' ? 'get-involved' : $content->page_key)) }}" target="_blank" rel="noopener">Preview ↗</a><button class="btn btn-primary" type="submit">Save and publish changes</button></div>
        </div>
    </form>
    <footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Website content studio</footer>
</main>
</div>
</div>
<script src="{{ asset('admin-static/js/admin.js') }}" defer></script>
</body>
</html>

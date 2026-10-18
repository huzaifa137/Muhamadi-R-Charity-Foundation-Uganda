<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow">
<title>Edit About page | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}"><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"><link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.ap-wrap{max-width:1100px}.ap-grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(260px,.42fr);gap:20px;align-items:start}.ap-card{padding:22px}.ap-field{display:grid;gap:7px;margin-bottom:17px}.ap-field label{font-size:.78rem;font-weight:800}.ap-field small{font-size:.72rem;color:var(--muted);line-height:1.55}.ap-field input,.ap-field textarea{width:100%;min-width:0;padding:11px 12px;border:1px solid var(--line);border-radius:10px;background:#fff;color:var(--ink);font:inherit;font-size:.82rem}.ap-field textarea{min-height:105px;resize:vertical;line-height:1.65}.ap-two{display:grid;grid-template-columns:1fr 1fr;gap:14px}.ap-alert{padding:12px 15px;border-radius:11px;margin-bottom:16px;background:#eefaf0;border:1px solid #cfe8d4;color:#245a36}.ap-errors{padding:12px 15px;border-radius:11px;margin-bottom:16px;background:#fff4f4;border:1px solid #efc7c7;color:#922b2b}.ap-preview{width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:12px;background:#eef1ed}.ap-actions{display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;margin-top:18px}.ap-note{font-size:.78rem;line-height:1.7;color:var(--muted)}.ap-section-title{margin:4px 0 16px;padding-bottom:10px;border-bottom:1px solid var(--line)}@media(max-width:850px){.ap-grid{grid-template-columns:1fr}}@media(max-width:560px){.ap-two{grid-template-columns:1fr}.ap-card{padding:16px}}
</style></head>
<body><div class="app">
@include('admin.partials.sidebar')
<div class="main"><header class="topbar"><button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button><div><b>About page editor</b><div class="xs muted">Foundation story, purpose and values</div></div><div class="top-actions"><a class="btn btn-outline btn-sm" href="{{ route('about') }}" target="_blank" rel="noopener">Preview page ↗</a><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-outline btn-sm" type="submit">Sign out</button></form></div></header>
<main class="content ap-wrap"><div class="page-head"><div class="crumb">Content management / About page</div><h1>About the foundation</h1><p>Update the public introduction, mission, vision, values and approach. Use confirmed organizational information only.</p></div>
@if(session('status'))<div class="ap-alert" role="status">{{ session('status') }}</div>@endif
@if($errors->any())<div class="ap-errors" role="alert"><b>Please correct the following:</b><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('admin.about.update') }}">@csrf @method('PUT')
<div class="ap-grid"><div style="display:grid;gap:20px">
<section class="card ap-card"><h3 class="ap-section-title">Hero section</h3>
<div class="ap-field"><label for="hero_eyebrow">Small label *</label><input id="hero_eyebrow" name="hero_eyebrow" maxlength="120" value="{{ old('hero_eyebrow', $content->hero_eyebrow) }}" required></div>
<div class="ap-field"><label for="hero_heading">Main heading *</label><textarea id="hero_heading" name="hero_heading" maxlength="220" required>{{ old('hero_heading', $content->hero_heading) }}</textarea></div>
<div class="ap-field"><label for="hero_intro">Introduction *</label><textarea id="hero_intro" name="hero_intro" maxlength="3000" required>{{ old('hero_intro', $content->hero_intro) }}</textarea></div>
</section>
<section class="card ap-card"><h3 class="ap-section-title">Who we are</h3>
<div class="ap-field"><label for="intro_heading">Section heading *</label><input id="intro_heading" name="intro_heading" maxlength="220" value="{{ old('intro_heading', $content->intro_heading) }}" required></div>
<div class="ap-field"><label for="intro_body">Main introduction *</label><textarea id="intro_body" name="intro_body" maxlength="5000" required>{{ old('intro_body', $content->intro_body) }}</textarea></div>
<div class="ap-field"><label for="intro_supporting">Supporting paragraph</label><textarea id="intro_supporting" name="intro_supporting" maxlength="5000">{{ old('intro_supporting', $content->intro_supporting) }}</textarea></div>
</section>
<section class="card ap-card"><h3 class="ap-section-title">Mission and vision</h3>
<div class="ap-field"><label for="mission">Mission *</label><textarea id="mission" name="mission" maxlength="5000" required>{{ old('mission', $content->mission) }}</textarea></div>
<div class="ap-field"><label for="vision">Vision *</label><textarea id="vision" name="vision" maxlength="5000" required>{{ old('vision', $content->vision) }}</textarea></div>
</section>
<section class="card ap-card"><h3 class="ap-section-title">Our values</h3><div class="ap-field"><label for="values_text">Values (one per line) *</label><textarea id="values_text" name="values_text" maxlength="6000" required>{{ old('values_text', $valuesText) }}</textarea><small>Use the format <b>Value title | Short description</b>. One value per line, maximum 12.</small></div></section>
<section class="card ap-card"><h3 class="ap-section-title">Our approach</h3>
<div class="ap-field"><label for="approach_heading">Section heading *</label><input id="approach_heading" name="approach_heading" maxlength="220" value="{{ old('approach_heading', $content->approach_heading) }}" required></div>
<div class="ap-field"><label for="approach_intro">Introduction *</label><textarea id="approach_intro" name="approach_intro" maxlength="3000" required>{{ old('approach_intro', $content->approach_intro) }}</textarea></div>
<div class="ap-field"><label for="steps_text">Approach steps (one per line) *</label><textarea id="steps_text" name="steps_text" maxlength="6000" required>{{ old('steps_text', $stepsText) }}</textarea><small>Use <b>Step title | Short description</b>, one per line. Maximum 12.</small></div>
</section></div>
<aside style="display:grid;gap:20px"><section class="card ap-card"><h3 class="ap-section-title">Images</h3>
<div class="ap-field"><label for="hero_image_path">Hero image path</label><input id="hero_image_path" name="hero_image_path" maxlength="500" value="{{ old('hero_image_path', $content->hero_image_path) }}" placeholder="assets/images/hero-community.webp"><small>Relative to the public folder. Use an existing image path.</small></div>
@if($content->hero_image_path)<img class="ap-preview" src="{{ asset($content->hero_image_path) }}" alt="Current hero image">@endif
<div class="ap-field" style="margin-top:18px"><label for="intro_image_path">Introduction image path</label><input id="intro_image_path" name="intro_image_path" maxlength="500" value="{{ old('intro_image_path', $content->intro_image_path) }}" placeholder="assets/images/project.webp"><small>File uploads are not included in this module.</small></div>
@if($content->intro_image_path)<img class="ap-preview" src="{{ asset($content->intro_image_path) }}" alt="Current introduction image">@endif
</section><section class="card ap-card"><h3 class="ap-section-title">Publishing guidance</h3><p class="ap-note">Saving updates the public About page immediately. Check spelling and obtain approval before changing official claims, registration information, leadership details or impact statements.</p><p class="ap-note" style="margin-top:12px">Each save is recorded in the administrator activity log.</p><a class="btn btn-outline" style="margin-top:14px" href="{{ route('about') }}" target="_blank" rel="noopener">Open public page ↗</a></section></aside></div>
<div class="ap-actions"><a class="btn btn-outline" href="{{ route('admin.dashboard') }}">Back to dashboard</a><button class="btn btn-primary" type="submit">Save About page</button></div>
</form><footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · About page editor</footer></main></div></div><script src="{{ asset('admin-static/js/admin.js') }}" defer></script></body></html>

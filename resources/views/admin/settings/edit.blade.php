<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow">
<title>Foundation settings | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.settings-page{max-width:1320px}.settings-hero{display:flex;align-items:flex-start;justify-content:space-between;gap:22px;flex-wrap:wrap;padding:27px 29px;margin-bottom:22px;border:1px solid #dcebe0;border-radius:18px;background:linear-gradient(125deg,#fff 0%,#f0f9f1 100%)}.settings-hero-copy{max-width:740px}.settings-eyebrow{display:inline-flex;align-items:center;gap:8px;color:var(--green-deep);font-size:.71rem;font-weight:800;letter-spacing:.09em;text-transform:uppercase}.settings-eyebrow-mark{width:8px;height:8px;border-radius:50%;background:var(--green)}.settings-hero h1{margin:7px 0 8px;letter-spacing:-.04em}.settings-hero p{color:var(--muted);font-size:.82rem;line-height:1.7}.settings-hero-actions{display:flex;gap:8px;flex-wrap:wrap}.settings-summary{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:13px;margin-bottom:24px}.settings-summary-card{display:flex;align-items:center;gap:13px;padding:16px 18px;border:1px solid var(--line);border-radius:14px;background:#fff;box-shadow:var(--shadow-soft)}.settings-summary-icon{display:grid;place-items:center;width:42px;height:42px;flex:0 0 42px;border-radius:13px;background:#e8f7ec;color:#087d3f;font-size:19px}.settings-summary-card strong{display:block;font-size:.87rem}.settings-summary-card small{display:block;color:var(--muted);font-size:.72rem;margin-top:3px;line-height:1.5}.settings-layout{display:grid;grid-template-columns:minmax(0,1fr) 290px;gap:20px;align-items:start}.settings-groups{display:grid;gap:16px}.settings-group{overflow:hidden;border:1px solid var(--line);border-radius:16px;background:#fff;box-shadow:var(--shadow-soft)}.settings-group-head{display:flex;align-items:center;gap:13px;padding:18px 21px;border-bottom:1px solid #edf0ec;background:#fcfdfb}.settings-group-icon{display:grid;place-items:center;flex:0 0 40px;width:40px;height:40px;border-radius:12px;background:#e8f7ec;color:#087d3f;font-size:18px}.settings-group-head h2{font-size:.92rem;text-transform:capitalize;letter-spacing:-.015em}.settings-group-head p{font-size:.72rem;color:var(--muted);margin-top:4px;line-height:1.5}.settings-group-body{padding:21px}.settings-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.settings-field{min-width:0}.settings-field label{display:block;font-size:.75rem;font-weight:800;margin-bottom:7px}.settings-field input{display:block;width:100%;min-width:0;min-height:43px;padding:10px 12px;border:1px solid #dce2dc;border-radius:10px;background:#fff;color:var(--ink);font:inherit;font-size:.8rem;transition:border-color .15s,box-shadow .15s}.settings-field input:focus{outline:none;border-color:var(--green-deep);box-shadow:0 0 0 3px rgba(8,125,63,.1)}.settings-field input[aria-invalid="true"]{border-color:#b42318}.settings-field small{display:block;color:var(--muted);font-size:.69rem;line-height:1.55;margin-top:6px}.settings-error{font-size:.7rem;color:#b42318;margin-top:6px}.settings-side{position:sticky;top:92px;display:grid;gap:14px}.settings-side-card{padding:19px;border:1px solid var(--line);border-radius:15px;background:#fff;box-shadow:var(--shadow-soft)}.settings-side-card h3{font-size:.86rem;margin-bottom:9px}.settings-side-card p,.settings-side-card li{font-size:.74rem;color:var(--muted);line-height:1.7}.settings-side-card ul{padding-left:17px;margin:9px 0 0}.settings-side-link{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:14px;padding-top:13px;border-top:1px solid var(--line);font-size:.75rem;font-weight:800;color:var(--green-deep)}.settings-actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap;padding:17px 0 4px}.settings-actions-note{font-size:.72rem;color:var(--muted);margin-left:auto}.settings-alert{margin-bottom:16px}.settings-validation{padding:13px 16px;border:1px solid #f0c7c7;border-radius:12px;background:#fff4f4;color:#922b2b;margin-bottom:16px;font-size:.78rem}.settings-validation ul{padding-left:18px;margin-top:6px}@media(max-width:1000px){.settings-layout{grid-template-columns:minmax(0,1fr) 250px}}@media(max-width:800px){.settings-layout{grid-template-columns:1fr}.settings-side{position:static;grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:620px){.settings-hero{padding:20px}.settings-summary{grid-template-columns:1fr}.settings-grid{grid-template-columns:1fr}.settings-group-body{padding:17px}.settings-side{grid-template-columns:1fr}.settings-actions-note{width:100%;margin-left:0}}
</style>
</head>
<body><div class="app">
@include('admin.partials.sidebar')
<div class="main">
<header class="topbar"><button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button><div><b>Foundation settings</b><div class="xs muted">Organisation-wide configuration</div></div><div class="top-actions"><a class="btn btn-outline btn-sm" href="{{ route('home') }}" target="_blank" rel="noopener">View website ↗</a></div></header>
<main class="content settings-page">
@if(session('status'))<div class="alert success settings-alert" role="status">{{ session('status') }}</div>@endif
@if($errors->any())<div class="settings-validation" role="alert"><strong>Some settings need your attention.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<section class="settings-hero"><div class="settings-hero-copy"><span class="settings-eyebrow"><span class="settings-eyebrow-mark"></span> Administration / Configuration</span><h1>Foundation settings</h1><p>Keep your organisation's public identity, contact information, notification routing and application timezone accurate. Changes are saved to the database and recorded in the administrator activity log.</p></div><div class="settings-hero-actions"><a class="btn btn-outline" href="{{ route('admin.activity-log.index') }}">View activity log ↗</a></div></section>
<div class="settings-summary">
<div class="settings-summary-card"><span class="settings-summary-icon">⚙</span><div><strong>{{ $settings->count() }} configuration items</strong><small>Current settings stored for this foundation</small></div></div>
<div class="settings-summary-card"><span class="settings-summary-icon">✉</span><div><strong>Contact &amp; notifications</strong><small>Public contact details and internal alert routing</small></div></div>
<div class="settings-summary-card"><span class="settings-summary-icon">◷</span><div><strong>Regional configuration</strong><small>Timezone used by the application</small></div></div>
</div>
<form method="POST" action="{{ route('admin.settings.update') }}">
@csrf @method('PUT')
<div class="settings-layout"><div class="settings-groups">
@foreach($settings->groupBy('group_name') as $group => $items)
@php
    $groupMeta = [
        'organisation' => ['icon' => '⌂', 'title' => 'Organisation', 'description' => 'The foundation name used to identify the organisation across the site.'],
        'contact' => ['icon' => '✉', 'title' => 'Public contact details', 'description' => 'Information visitors use to contact or locate the foundation.'],
        'notifications' => ['icon' => '↗', 'title' => 'Notifications', 'description' => 'Internal email address used for operational notifications.'],
        'system' => ['icon' => '◷', 'title' => 'System preferences', 'description' => 'Regional settings for displaying and processing dates.'],
    ];
    $meta = $groupMeta[$group] ?? ['icon' => '⚙', 'title' => str_replace('_', ' ', $group), 'description' => 'Configuration for this area of the foundation website.'];
@endphp
<section class="settings-group"><div class="settings-group-head"><span class="settings-group-icon" aria-hidden="true">{{ $meta['icon'] }}</span><div><h2>{{ $meta['title'] }}</h2><p>{{ $meta['description'] }}</p></div></div><div class="settings-group-body"><div class="settings-grid">
@foreach($items as $setting)
<div class="settings-field"><label for="setting-{{ $setting->key }}">{{ $setting->label }}</label><input id="setting-{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ old('settings.'.$setting->key, $setting->value) }}" @if($setting->key === 'public_email' || $setting->key === 'notification_email') type="email" autocomplete="email" @else type="text" @endif @if($setting->key === 'foundation_name' || $setting->key === 'timezone') required @endif @if($errors->has('settings.'.$setting->key)) aria-invalid="true" @endif>
@if($setting->key === 'foundation_name')<small>Displayed as the foundation's name across the website.</small>
@elseif($setting->key === 'public_email')<small>Shown to visitors as the main contact email.</small>
@elseif($setting->key === 'public_phone')<small>Use the preferred public telephone format, including country code.</small>
@elseif($setting->key === 'office_address')<small>Public-facing office location or postal address.</small>
@elseif($setting->key === 'notification_email')<small>Receives operational email alerts. SMTP must also be configured on the server.</small>
@elseif($setting->key === 'timezone')<small>Use a valid PHP timezone, for example Africa/Kampala.</small>@endif
@error('settings.'.$setting->key)<div class="settings-error">{{ $message }}</div>@enderror
</div>
@endforeach
</div></div></section>
@endforeach
<div class="settings-actions"><button class="btn btn-primary" type="submit">Save changes</button><a class="btn btn-outline" href="{{ route('admin.dashboard') }}">Cancel</a><span class="settings-actions-note">Saved changes are recorded in the activity log.</span></div>
</div>
<aside class="settings-side">
<section class="settings-side-card"><h3>Before you save</h3><p>Review changes carefully. Public contact details can be visible to all website visitors.</p><ul><li>Use an inbox monitored by your team.</li><li>Confirm the correct office details.</li><li>Choose the correct timezone for Uganda if applicable.</li></ul></section>
<section class="settings-side-card"><h3>Email delivery</h3><p>These settings route notifications; they do not configure mail transport. Server SMTP credentials and sender settings must be valid for email delivery.</p></section>
<section class="settings-side-card"><h3>Accountability</h3><p>Settings updates are recorded with the administrator account and request IP address.</p><a class="settings-side-link" href="{{ route('admin.activity-log.index') }}">Open activity history <span>→</span></a></section>
</aside></div>
</form>
<footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Foundation settings</footer>
</main></div></div><script src="{{ asset('admin-static/js/admin.js') }}" defer></script></body></html>
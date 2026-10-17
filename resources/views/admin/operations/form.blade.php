<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow">
<title>{{ $record ? 'Edit' : 'Create' }} {{ $config['title'] }} | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}"><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"><link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.op-wrap{max-width:1480px}.op-hero{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;flex-wrap:wrap}.op-eyebrow{font-size:.7rem;text-transform:uppercase;letter-spacing:.12em;font-weight:800;color:var(--muted)}.op-hero h1{margin:7px 0 8px}.op-hero p{max-width:700px}.op-layout{display:grid;grid-template-columns:minmax(0,1fr) 300px;gap:20px;align-items:start;margin-top:22px}.op-card{padding:22px}.op-section-title{font-size:.96rem;margin:0 0 18px;padding-bottom:13px;border-bottom:1px solid var(--line)}.op-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.op-field{min-width:0}.op-field label{display:block;font-size:.76rem;font-weight:800;margin-bottom:7px}.op-field input,.op-field textarea,.op-field select{display:block;width:100%;min-width:0;padding:11px 12px;border:1px solid var(--line);border-radius:10px;background:#fff;color:var(--ink);font:inherit;font-size:.8rem;outline:none}.op-field input:focus,.op-field textarea:focus,.op-field select:focus{border-color:#4b8a5d;box-shadow:0 0 0 3px #e8f5eb}.op-field textarea{min-height:130px;resize:vertical;line-height:1.65}.op-field small{display:block;margin-top:6px;color:var(--muted);font-size:.7rem;line-height:1.55}.op-wide{grid-column:1/-1}.op-error{display:block;color:#a02f28;font-size:.72rem;margin-top:6px}.op-alert{padding:13px 16px;border-radius:11px;margin:16px 0;background:#fff1ef;border:1px solid #f0ceca;color:#922e25;font-size:.83rem}.op-actions{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-top:22px;padding-top:18px;border-top:1px solid var(--line)}.op-action-group{display:flex;gap:9px;flex-wrap:wrap}.op-note{font-size:.76rem;color:var(--muted);line-height:1.7}.op-preview{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:12px;border:1px solid var(--line);background:#f2f5f1}.op-status-help{padding:13px;border-radius:11px;background:#f5f8f4;color:#536456;font-size:.75rem;line-height:1.7}.op-module-strip{display:flex;gap:8px;flex-wrap:wrap;margin:18px 0 0}.op-module-link{display:inline-flex;padding:8px 10px;border:1px solid var(--line);border-radius:9px;color:var(--muted);font-size:.7rem;font-weight:800;background:#fff}.op-module-link.active{background:#eaf6ed;border-color:#c6e3ce;color:#205c35}@media(max-width:1050px){.op-layout{grid-template-columns:1fr}.op-aside{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.op-aside .card{margin:0}}@media(max-width:700px){.op-grid{grid-template-columns:1fr}.op-wide{grid-column:auto}.op-card{padding:16px}.op-aside{grid-template-columns:1fr}.op-module-strip{gap:6px}}
</style>
</head>
<body><div class="app">
<aside class="sidebar" id="sidebar">
<a class="side-brand" href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/images/logo.webp') }}" alt="Foundation logo"><span><b>Muhamadi R Charity</b><small>Admin Console</small></span></a>
<nav class="side-scroll">
<div class="nav-label">Overview</div><a class="nav-item" href="{{ route('admin.dashboard') }}">▦ &nbsp; Dashboard</a>
<div class="nav-label">Content management</div><a class="nav-item" href="{{ route('admin.programs.index') }}">◇ &nbsp; Programs</a><a class="nav-item" href="{{ route('admin.about.edit') }}">♡ &nbsp; About page</a>
<div class="nav-label">Operations</div>
@php($opNav = [
 ['key'=>'donations','label'=>'Donations & receipts','roles'=>['super_admin','administrator','finance_manager'],'icon'=>'₵'],
 ['key'=>'impact','label'=>'Projects & impact','roles'=>['super_admin','administrator','content_manager'],'icon'=>'↗'],
 ['key'=>'stories','label'=>'Stories & news','roles'=>['super_admin','administrator','content_manager'],'icon'=>'▤'],
 ['key'=>'gallery','label'=>'Gallery management','roles'=>['super_admin','administrator','content_manager'],'icon'=>'▧'],
 ['key'=>'volunteers','label'=>'Volunteer applications','roles'=>['super_admin','administrator','content_manager','finance_manager'],'icon'=>'♙'],
 ['key'=>'enquiries','label'=>'Contact & enquiries','roles'=>['super_admin','administrator','content_manager','finance_manager'],'icon'=>'✉']
])
@foreach($opNav as $item) @if(in_array($adminRole,$item['roles'],true))
<a class="nav-item {{ $config['key']===$item['key'] ? 'active' : '' }}" href="{{ route('admin.operations.index',$item['key']) }}">{{ $item['icon'] }} &nbsp; {{ $item['label'] }}</a>
@endif @endforeach
@if(in_array($adminRole,['super_admin','administrator'],true))<div class="nav-label">Administration</div><a class="nav-item" href="{{ route('admin.staff.index') }}">♙ &nbsp; Staff & permissions</a>@endif
<div class="nav-label">Public website</div><a class="nav-item" href="{{ route('home') }}" target="_blank" rel="noopener">↗ &nbsp; View website</a>
</nav><div class="side-foot"><div class="side-card"><b class="small">Operations workspace</b><p>Keep operational information accurate, complete and approved before publishing.</p><a href="{{ route('admin.operations.index',$config['key']) }}">Back to {{ $config['title'] }} ↗</a></div></div>
</aside>
<div class="main">
<header class="topbar"><button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button><div><b>{{ $record ? 'Edit record' : 'Create record' }}</b><div class="xs muted">{{ $config['title'] }} · Operations workspace</div></div><div class="top-actions"><a class="btn btn-outline btn-sm" href="{{ route('admin.operations.index',$config['key']) }}">Back to register</a><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-outline btn-sm" type="submit">Sign out</button></form></div></header>
<main class="content op-wrap">
<div class="op-hero"><div><div class="op-eyebrow">Operations / {{ $config['title'] }} / {{ $record ? 'Edit' : 'New record' }}</div><h1>{{ $record ? 'Manage record' : 'Add a record' }}</h1><p class="muted">{{ $config['description'] }} Fields marked with an asterisk are required.</p></div><a class="btn btn-outline" href="{{ route('admin.operations.index',$config['key']) }}">← All {{ $config['title'] }}</a></div>
@if($errors->any())<div class="op-alert" role="alert"><b>Please correct the highlighted fields.</b><ul style="margin:7px 0 0 18px">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="op-module-strip" aria-label="Operations sections">@foreach($opNav as $item) @if(in_array($adminRole,$item['roles'],true))<a class="op-module-link {{ $config['key']===$item['key']?'active':'' }}" href="{{ route('admin.operations.index',$item['key']) }}">{{ $item['label'] }}</a>@endif @endforeach</div>
<form method="POST" enctype="multipart/form-data" action="{{ $record ? route('admin.operations.update',[$config['key'],$record->id]) : route('admin.operations.store',$config['key']) }}">
@csrf @if($record) @method('PUT') @endif
<div class="op-layout"><section class="card op-card"><h2 class="op-section-title">{{ $record ? 'Record details' : 'New record details' }}</h2><div class="op-grid">
@foreach($config['fields'] as $field)
<div class="op-field {{ in_array($field['type'],['textarea'],true) ? 'op-wide' : '' }}">
<label for="{{ $field['name'] }}">{{ $field['label'] }} @if(!empty($field['required']))<span aria-hidden="true">*</span>@endif</label>
@if($field['type']==='textarea')
<textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" @if(!empty($field['required'])) required @endif maxlength="{{ in_array($field['name'],['description','body','message','motivation','experience','admin_notes','response_notes','outcome','caption'],true)?20000:(in_array($field['name'],['summary','excerpt'],true)?700:500) }}">{{ old($field['name'],$record->{$field['name']} ?? '') }}</textarea>
@elseif($field['type']==='select')
<select id="{{ $field['name'] }}" name="{{ $field['name'] }}" @if(!empty($field['required'])) required @endif>@foreach($field['options'] as $value=>$label)<option value="{{ $value }}" @selected(old($field['name'],$record->{$field['name']} ?? ($value===array_key_first($field['options'])?$value:''))===$value)>{{ $label }}</option>@endforeach</select>
@elseif($field['type']==='file')
@if($record && $record->image_path)<img class="op-preview" style="margin-bottom:10px" src="{{ str_starts_with($record->image_path,'http') ? $record->image_path : asset($record->image_path) }}" alt="{{ $record->alt_text ?? 'Current gallery image' }}">@endif
<input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="file" accept="image/jpeg,image/png,image/webp" @if(!$record) required @endif><small>JPEG, PNG or WebP; maximum 5 MB. @if($record) Leave blank to keep the current image.@endif</small>
@else
<input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" value="{{ old($field['name'],$record->{$field['name']} ?? (in_array($field['name'],['currency'],true)?'UGX':(in_array($field['name'],['sort_order'],true)?0:''))) }}" @if(!empty($field['required'])) required @endif @if($field['type']==='number') min="0" step="{{ $field['name']==='amount'?'0.01':'1' }}" @endif @if($field['type']==='date') max="2099-12-31" @endif>
@endif
@error($field['name'])<span class="op-error">{{ $message }}</span>@enderror
</div>
@endforeach
</div><div class="op-actions"><a class="btn btn-outline" href="{{ route('admin.operations.index',$config['key']) }}">Cancel</a><div class="op-action-group"><button class="btn btn-primary" type="submit">{{ $record ? 'Save changes' : 'Create record' }}</button></div></div></section>
<aside class="op-aside" style="display:grid;gap:16px"><section class="card op-card"><h3 class="op-section-title">Before you save</h3><p class="op-note">Review spelling, contact details, dates and status. Published content may appear on the public website as soon as it is saved.</p><p class="op-note" style="margin-top:12px">Administrative changes are recorded in the activity log for accountability.</p></section><section class="card op-card"><h3 class="op-section-title">Publishing & access</h3><div class="op-status-help">Your account role: <b>{{ str_replace('_',' ',$adminRole) }}</b><br>Access to this section is checked on the server for every save, edit and delete action.</div>@if(in_array($config['key'],['impact','stories'],true))<p class="op-note" style="margin-top:12px">Draft records stay off the public pages. Choose Published only when the content has been reviewed.</p>@elseif($config['key']==='donations')<p class="op-note" style="margin-top:12px">Only confirmed paid donations can have a printable receipt. Public pledges start as pending.</p>@elseif($config['key']==='gallery')<p class="op-note" style="margin-top:12px">Provide meaningful alt text so visitors using assistive technology can understand the image.</p>@endif</section></aside>
</div></form><footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Operations management</footer>
</main></div></div><script src="{{ asset('admin-static/js/admin.js') }}" defer></script></body></html>
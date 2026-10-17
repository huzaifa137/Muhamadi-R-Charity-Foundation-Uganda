<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Programs management | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.pm-top{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap}.pm-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin-bottom:20px}.pm-stat{padding:18px;border:1px solid var(--line);border-radius:14px;background:#fff}.pm-stat b{display:block;font-size:1.55rem}.pm-stat span{font-size:.76rem;color:var(--muted)}.pm-table-wrap{overflow:auto}.pm-table{width:100%;border-collapse:collapse;min-width:680px}.pm-table th,.pm-table td{padding:14px;text-align:left;border-bottom:1px solid var(--line);vertical-align:middle;font-size:.8rem}.pm-table th{font-size:.68rem;color:var(--muted);letter-spacing:.07em;text-transform:uppercase}.pm-title{display:flex;align-items:center;gap:12px}.pm-thumb{width:58px;height:48px;object-fit:cover;border-radius:9px;background:#eef1ed}.pm-status{display:inline-block;border-radius:99px;padding:5px 9px;font-size:.68rem;font-weight:800}.pm-status.published{background:#e8f7ec;color:#176638}.pm-status.draft{background:#fff4df;color:#8a5b00}.pm-actions{display:flex;gap:7px;align-items:center;flex-wrap:wrap}.pm-actions form{margin:0}.pm-delete{border:1px solid #f0c7c7;color:#a62c35;background:#fff;padding:7px 10px;border-radius:9px;font:inherit;font-size:.72rem;font-weight:800;cursor:pointer}.pm-delete:hover{background:#fff4f4}.pm-alert{padding:12px 15px;border-radius:11px;margin-bottom:16px;background:#eefaf0;border:1px solid #cfe8d4;color:#245a36}.pm-errors{padding:12px 15px;border-radius:11px;margin-bottom:16px;background:#fff4f4;border:1px solid #efc7c7;color:#922b2b}.pm-pager{padding:15px;display:flex;justify-content:space-between;gap:12px;align-items:center;font-size:.78rem}@media(max-width:600px){.pm-stats{grid-template-columns:1fr}}
</style>
</head>
<body><div class="app">
@include('admin.partials.sidebar')
<div class="main"><header class="topbar"><button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button><div><b>Programs management</b><div class="xs muted">Create, edit and publish foundation programs</div></div><div class="top-actions"><a class="btn btn-outline btn-sm" href="{{ route('programs') }}" target="_blank" rel="noopener">View public page ↗</a><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-outline btn-sm" type="submit">Sign out</button></form></div></header>
<main class="content">
<div class="page-head pm-top"><div><div class="crumb">Content management / Programs</div><h1>Programs</h1><p>Manage the focus areas shown on the public website. Drafts remain private.</p></div><a class="btn btn-primary" href="{{ route('admin.programs.create') }}">＋ &nbsp; Add program</a></div>
@if(session('status'))<div class="pm-alert" role="status">{{ session('status') }}</div>@endif
@if($errors->any())<div class="pm-errors" role="alert"><b>Please correct the following:</b><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="pm-stats"><div class="pm-stat"><b>{{ number_format($programs->total()) }}</b><span>All programs</span></div><div class="pm-stat"><b>{{ number_format($publishedCount) }}</b><span>Published on website</span></div><div class="pm-stat"><b>{{ number_format($draftCount) }}</b><span>Drafts / unpublished</span></div></div>
<section class="card"><div class="card-head"><div><h3>Program catalogue</h3><p>Changes are saved to the database and reflected on the public programs page.</p></div></div>
<div class="pm-table-wrap"><table class="pm-table"><thead><tr><th>Program</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead><tbody>
@forelse($programs as $program)<tr><td><div class="pm-title">@if($program->image_path)<img class="pm-thumb" src="{{ asset($program->image_path) }}" alt="">@else<div class="pm-thumb"></div>@endif<div><b>{{ $program->title }}</b><span class="dash-sub">{{ $program->slug }}</span></div></div></td><td><span class="pm-status {{ $program->status }}">{{ ucfirst($program->status) }}</span></td><td>{{ $program->sort_order }}</td><td><div class="pm-actions"><a class="btn btn-outline btn-sm" href="{{ route('admin.programs.edit', $program) }}">Edit</a><form method="POST" action="{{ route('admin.programs.destroy', $program) }}" onsubmit="return confirm('Delete this program permanently?')">@csrf @method('DELETE')<button class="pm-delete" type="submit">Delete</button></form></div></td></tr>
@empty<tr><td colspan="4" class="dash-empty">No programs have been created yet. Add your first program to begin.</td></tr>@endforelse
</tbody></table></div>
@if($programs->hasPages())<div class="pm-pager"><span>Showing {{ $programs->firstItem() }}–{{ $programs->lastItem() }} of {{ $programs->total() }}</span><div class="row" style="gap:8px">@if($programs->previousPageUrl())<a class="btn btn-outline btn-sm" href="{{ $programs->previousPageUrl() }}">Previous</a>@endif @if($programs->nextPageUrl())<a class="btn btn-outline btn-sm" href="{{ $programs->nextPageUrl() }}">Next</a>@endif</div></div>@endif
</section><footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Programs management</footer>
</main></div></div><script src="{{ asset('admin-static/js/admin.js') }}" defer></script></body></html>

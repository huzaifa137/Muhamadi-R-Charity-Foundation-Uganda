<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow">
<title>{{ $config['title'] }} | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}"><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.op-wrap{max-width:1480px}.op-hero{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;flex-wrap:wrap}.op-eyebrow{font-size:.7rem;text-transform:uppercase;letter-spacing:.12em;font-weight:800;color:var(--muted)}.op-hero h1{margin:7px 0 8px}.op-hero p{max-width:680px}.op-stat-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin:22px 0}.op-stat{padding:17px 19px}.op-stat strong{display:block;font-size:1.5rem;letter-spacing:-.04em}.op-stat span{display:block;color:var(--muted);font-size:.75rem;margin-top:5px}.op-toolbar{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:17px 20px;border-bottom:1px solid var(--line)}.op-table-wrap{overflow:auto}.op-table{width:100%;border-collapse:collapse;min-width:760px}.op-table th,.op-table td{padding:15px 18px;border-bottom:1px solid var(--line);text-align:left;vertical-align:top;font-size:.79rem}.op-table th{font-size:.66rem;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);background:#fbfcfa}.op-table tbody tr:last-child td{border-bottom:0}.op-record-title{font-weight:800;color:var(--ink);max-width:350px}.op-meta{color:var(--muted);font-size:.73rem;line-height:1.6;margin-top:5px;overflow-wrap:anywhere}.op-status{display:inline-flex;align-items:center;gap:6px;border-radius:999px;padding:5px 9px;font-size:.68rem;font-weight:800;text-transform:capitalize;background:#eef2ee;color:#526055}.op-status.published,.op-status.paid,.op-status.approved,.op-status.responded{background:#e8f7ed;color:#20683a}.op-status.draft,.op-status.pending,.op-status.new,.op-status.reviewing,.op-status.in_progress{background:#fff4dc;color:#805c12}.op-status.declined,.op-status.failed,.op-status.closed,.op-status.refunded{background:#fff0ee;color:#9c3930}.op-row-actions{display:flex;align-items:center;gap:7px;flex-wrap:wrap;min-width:140px}.op-row-actions form{margin:0}.op-empty{padding:44px 22px;text-align:center}.op-empty h3{margin:0 0 8px}.op-empty p{color:var(--muted);font-size:.82rem;margin-bottom:18px}.op-pagination{padding:16px 20px;border-top:1px solid var(--line)}.op-module-strip{display:flex;gap:8px;flex-wrap:wrap;margin:0 0 18px}.op-module-link{display:inline-flex;align-items:center;padding:9px 12px;border:1px solid var(--line);border-radius:10px;color:var(--muted);font-size:.74rem;font-weight:800;background:#fff}.op-module-link.active{background:#eaf6ed;border-color:#c6e3ce;color:#205c35}.op-alert{padding:13px 16px;border-radius:11px;margin:16px 0;background:#eaf8ed;border:1px solid #cce8d2;color:#245d37;font-size:.83rem}.op-errors{padding:13px 16px;border-radius:11px;margin:16px 0;background:#fff1ef;border:1px solid #f0ceca;color:#922e25;font-size:.83rem}.op-small{font-size:.73rem;color:var(--muted)}@media(max-width:700px){.op-stat-grid{grid-template-columns:1fr}.op-toolbar{align-items:flex-start}.op-table th,.op-table td{padding:12px}.op-module-strip{gap:6px}.op-module-link{font-size:.68rem;padding:8px 10px}}
</style>
</head>
<body><div class="app">
@php
    $opNav = [
        ['key' => 'donations', 'label' => 'Donations & receipts', 'roles' => ['super_admin', 'administrator', 'finance_manager']],
        ['key' => 'impact', 'label' => 'Projects & impact', 'roles' => ['super_admin', 'administrator', 'content_manager']],
        ['key' => 'stories', 'label' => 'Stories & news', 'roles' => ['super_admin', 'administrator', 'content_manager']],
        ['key' => 'gallery', 'label' => 'Gallery management', 'roles' => ['super_admin', 'administrator', 'content_manager']],
        ['key' => 'volunteers', 'label' => 'Volunteer applications', 'roles' => ['super_admin', 'administrator', 'content_manager', 'finance_manager']],
        ['key' => 'enquiries', 'label' => 'Contact enquiries', 'roles' => ['super_admin', 'administrator', 'content_manager', 'finance_manager']],
    ];
@endphp
@include('admin.partials.sidebar')
<div class="main">
<header class="topbar"><button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button><div><b>Operations workspace</b><div class="xs muted">{{ $config['title'] }} · Manage foundation records</div></div><div class="top-actions"><a class="btn btn-outline btn-sm" href="{{ route('admin.dashboard') }}">Dashboard</a><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-outline btn-sm" type="submit">Sign out</button></form></div></header>
<main class="content op-wrap">
<div class="op-hero"><div><div class="op-eyebrow">Foundation operations / {{ $config['title'] }}</div><h1>{{ $config['title'] }}</h1><p class="muted">{{ $config['description'] }}</p></div><div style="display:flex;gap:9px;flex-wrap:wrap"><a class="btn btn-outline" href="{{ route('admin.dashboard') }}">← Dashboard</a><a class="btn btn-primary" href="{{ route('admin.operations.create',$config['key']) }}">＋ Add {{ rtrim($config['title'],'s') }}</a></div></div>
@if(session('status'))<div class="op-alert" role="status">✓ &nbsp; {{ session('status') }}</div>@endif
@if($errors->any())<div class="op-errors" role="alert"><b>Please review the following:</b>@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<div class="op-module-strip" aria-label="Operations sections">@foreach($opNav as $item) @if(in_array($adminRole,$item['roles'],true))<a class="op-module-link {{ $config['key']===$item['key']?'active':'' }}" href="{{ route('admin.operations.index',$item['key']) }}">{{ $item['label'] }}</a>@endif @endforeach</div>
<div class="op-stat-grid"><section class="card op-stat"><span>Records in this section</span><strong>{{ number_format($records->total()) }}</strong><span>All records, including older pages</span></section><section class="card op-stat"><span>Current view</span><strong>{{ $records->count() }}</strong><span>Records shown on this page</span></section><section class="card op-stat"><span>Page</span><strong>{{ $records->currentPage() }} <span style="display:inline;font-size:.85rem">/ {{ $records->lastPage() }}</span></strong><span>Use the controls below to browse records</span></section></div>
<section class="card" style="padding:0;overflow:hidden">
<div class="op-toolbar"><div><b>{{ $config['title'] }} register</b><div class="op-small" style="margin-top:4px">Review and update saved records. Changes are logged.</div></div><span class="op-small">Newest records first</span></div>
<div class="op-table-wrap"><table class="op-table"><thead><tr><th>Record</th><th>Status / details</th><th>Created</th><th>Actions</th></tr></thead><tbody>
@forelse($records as $record)
@php($recordStatus = $record->status ?? $record->payment_status ?? 'recorded')
<tr><td><div class="op-record-title">{{ $record->title ?? $record->donor_name ?? $record->name ?? $record->subject ?? 'Record #'.$record->id }}</div>
@if(isset($record->email))<div class="op-meta">{{ $record->email }}</div>@endif
@if(isset($record->phone))<div class="op-meta">{{ $record->phone }}</div>@endif
@if(isset($record->amount))<div class="op-meta"><b>{{ $record->currency }} {{ number_format((float)$record->amount,2) }}</b></div>@endif
@if(isset($record->receipt_number) && $record->receipt_number)<div class="op-meta">Receipt: {{ $record->receipt_number }}</div>@endif
@if(isset($record->summary))<div class="op-meta">{{ \Illuminate\Support\Str::limit($record->summary,100) }}</div>@elseif(isset($record->message))<div class="op-meta">{{ \Illuminate\Support\Str::limit($record->message,100) }}</div>@elseif(isset($record->motivation))<div class="op-meta">{{ \Illuminate\Support\Str::limit($record->motivation,100) }}</div>@endif
@if(isset($record->image_path) && $record->image_path)<div class="op-meta">{{ \Illuminate\Support\Str::limit($record->image_path,75) }}</div>@endif
</td><td><span class="op-status {{ \Illuminate\Support\Str::slug((string)$recordStatus) }}">{{ str_replace('_',' ',ucfirst($recordStatus)) }}</span>
@if(isset($record->beneficiaries_count) && $record->beneficiaries_count!==null)<div class="op-meta">Beneficiaries: {{ number_format($record->beneficiaries_count) }}</div>@endif
@if(isset($record->area_of_interest))<div class="op-meta">{{ $record->area_of_interest }}</div>@endif
@if(isset($record->payment_method))<div class="op-meta">{{ $record->payment_method }}</div>@endif
@if(isset($record->category))<div class="op-meta">{{ $record->category }}</div>@endif
</td><td><div>{{ isset($record->created_at) ? \Illuminate\Support\Carbon::parse($record->created_at)->format('d M Y') : '—' }}</div><div class="op-meta">{{ isset($record->updated_at) ? 'Updated '.\Illuminate\Support\Carbon::parse($record->updated_at)->format('d M Y') : '' }}</div></td>
<td><div class="op-row-actions"><a class="btn btn-outline btn-sm" href="{{ route('admin.operations.edit',[$config['key'],$record->id]) }}">Edit / manage</a>
@if($config['key']==='donations' && ($record->payment_status ?? '')==='paid')<a class="btn btn-outline btn-sm" target="_blank" rel="noopener" href="{{ route('admin.donations.receipt',$record->id) }}">Receipt ↗</a>@endif
<form method="POST" action="{{ route('admin.operations.destroy',[$config['key'],$record->id]) }}" onsubmit="return confirm('Delete this record permanently? This cannot be undone.')">@csrf @method('DELETE')<button class="btn btn-outline btn-sm" type="submit">Delete</button></form></div></td></tr>
@empty<tr><td colspan="4"><div class="op-empty"><h3>No records here yet</h3><p>Once you add a record or receive a public submission, it will appear in this register.</p><a class="btn btn-primary" href="{{ route('admin.operations.create',$config['key']) }}">＋ Create first record</a></div></td></tr>@endforelse
</tbody></table></div>
@if($records->hasPages())<div class="op-pagination">{{ $records->links() }}</div>@endif
</section>
<footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Operations management</footer>
</main></div></div><script src="{{ asset('admin-static/js/admin.js') }}" defer></script></body></html>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>{{ $config['title'] }} | Admin</title><link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}"><style>.op-wrap{max-width:1400px;margin:auto;padding:26px}.op-head{display:flex;justify-content:space-between;gap:18px;align-items:flex-start;flex-wrap:wrap}.op-table{width:100%;border-collapse:collapse}.op-table th,.op-table td{padding:13px 12px;border-bottom:1px solid #e5e9e5;text-align:left;font-size:.84rem;vertical-align:top}.op-table th{font-size:.72rem;text-transform:uppercase;color:#68756c}.op-actions{display:flex;gap:8px;flex-wrap:wrap}.op-actions form{display:inline}.op-muted{color:#657166;font-size:.82rem}.op-alert{padding:12px 16px;background:#e8f7ec;border-radius:10px;margin:18px 0}.op-content{margin-top:22px;background:#fff;border:1px solid #e5e9e5;border-radius:16px;overflow:hidden}.op-empty{text-align:center;padding:30px;color:#657166}@media(max-width:700px){.op-wrap{padding:16px}.op-table th,.op-table td{padding:10px 7px}.hide-sm{display:none}}</style></head><body><div class="op-wrap">
<div class="op-head"><div><p class="op-muted"><a href="{{ route('admin.dashboard') }}">← Dashboard</a> / Operations</p><h1>{{ $config['title'] }}</h1><p class="op-muted">{{ $config['description'] }}</p></div><div class="op-actions"><a class="btn btn-outline" href="{{ route('admin.dashboard') }}">Dashboard</a><a class="btn btn-primary" href="{{ route('admin.operations.create', $config['key']) }}">+ Add record</a></div></div>
@if(session('status'))<div class="op-alert">{{ session('status') }}</div>@endif
@if($errors->any())<div class="op-alert" role="alert">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
<div class="op-content"><div style="overflow-x:auto"><table class="op-table"><thead><tr><th>Record</th><th>Status / details</th><th class="hide-sm">Created</th><th>Actions</th></tr></thead><tbody>
@forelse($records as $record)
<tr><td><strong>{{ $record->title ?? $record->donor_name ?? $record->name ?? $record->subject ?? 'Record #'.$record->id }}</strong>
@if(isset($record->email))<div class="op-muted">{{ $record->email }}</div>@endif
@if(isset($record->amount))<div class="op-muted">{{ $record->currency }} {{ number_format((float)$record->amount, 2) }}</div>@endif
@if(isset($record->receipt_number) && $record->receipt_number)<div class="op-muted">Receipt: {{ $record->receipt_number }}</div>@endif
@if(isset($record->summary))<div class="op-muted">{{ \Illuminate\Support\Str::limit($record->summary, 100) }}</div>@endif
@if(isset($record->message))<div class="op-muted">{{ \Illuminate\Support\Str::limit($record->message, 100) }}</div>@endif
@if(isset($record->image_path) && $record->image_path)<div class="op-muted">{{ $record->image_path }}</div>@endif
</td><td><strong>{{ str_replace('_',' ',ucfirst($record->status ?? $record->payment_status ?? 'recorded')) }}</strong>
@if(isset($record->beneficiaries_count) && $record->beneficiaries_count !== null)<div class="op-muted">Beneficiaries recorded: {{ number_format($record->beneficiaries_count) }}</div>@endif
@if(isset($record->area_of_interest))<div class="op-muted">{{ $record->area_of_interest }}</div>@endif
@if(isset($record->payment_method))<div class="op-muted">{{ $record->payment_method }}</div>@endif
</td><td class="hide-sm">{{ isset($record->created_at) ? \Illuminate\Support\Carbon::parse($record->created_at)->format('d M Y') : '—' }}</td><td><div class="op-actions"><a class="btn btn-outline btn-sm" href="{{ route('admin.operations.edit', [$config['key'], $record->id]) }}">Manage</a>
@if($config['key']==='donations' && ($record->payment_status ?? '')==='paid')<a class="btn btn-outline btn-sm" target="_blank" rel="noopener" href="{{ route('admin.donations.receipt', $record->id) }}">Receipt</a>@endif
<form method="POST" action="{{ route('admin.operations.destroy', [$config['key'], $record->id]) }}" onsubmit="return confirm('Delete this record permanently?')">@csrf @method('DELETE')<button class="btn btn-outline btn-sm" type="submit">Delete</button></form></div></td></tr>
@empty<tr><td colspan="4" class="op-empty">No records yet. New public submissions and records will appear here.</td></tr>@endforelse
</tbody></table></div></div><div style="margin-top:18px">{{ $records->links() }}</div></div></body></html>

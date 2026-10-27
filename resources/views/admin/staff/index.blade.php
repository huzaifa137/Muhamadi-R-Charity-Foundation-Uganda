<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Staff &amp; permissions | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<style>
.staff-intro{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;flex-wrap:wrap}.staff-note{padding:14px 16px;border:1px solid #cfe8d4;background:#f0faf2;color:#315541;border-radius:13px;font-size:.82rem;line-height:1.65;margin-bottom:20px}.staff-note strong{color:#183b29}.staff-grid{display:grid;grid-template-columns:minmax(0,1.25fr) minmax(280px,.75fr);gap:20px;align-items:start}.staff-form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}.staff-field{display:grid;gap:6px;margin-bottom:12px}.staff-field label{font-size:.78rem;font-weight:800}.staff-field input,.staff-field select{width:100%;min-width:0;padding:11px 12px;border:1px solid var(--line);border-radius:10px;background:#fff;font:inherit;font-size:.82rem;color:var(--ink)}.staff-field small{font-size:.72rem;color:var(--muted);line-height:1.5}.staff-table-wrap{overflow-x:auto}.staff-table{width:100%;border-collapse:collapse;min-width:760px}.staff-table th,.staff-table td{padding:12px 13px;text-align:left;border-bottom:1px solid var(--line);vertical-align:top}.staff-table th{font-size:.68rem;text-transform:uppercase;letter-spacing:.06em;color:var(--muted)}.staff-table td{font-size:.8rem}.staff-table tr:last-child td{border-bottom:0}.staff-role{display:inline-block;border-radius:999px;padding:5px 8px;font-size:.67rem;font-weight:800;background:#edf4ff;color:#315b91}.staff-status{display:inline-block;border-radius:999px;padding:5px 8px;font-size:.67rem;font-weight:800}.staff-status.active{background:#e8f7ec;color:#176638}.staff-status.inactive{background:#fff0f0;color:#a82d35}.staff-edit{margin-top:10px;padding-top:10px;border-top:1px dashed var(--line)}.staff-edit summary{cursor:pointer;color:var(--green);font-size:.75rem;font-weight:800}.staff-edit-fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px;margin-top:10px}.staff-edit-fields input,.staff-edit-fields select{width:100%;min-width:0;padding:9px;border:1px solid var(--line);border-radius:8px;font:inherit;font-size:.76rem}.staff-activity{display:grid;gap:0}.staff-event{padding:12px 0;border-bottom:1px solid var(--line)}.staff-event:last-child{border:0}.staff-event b{font-size:.8rem}.staff-event p{font-size:.74rem;color:var(--muted);margin-top:3px;line-height:1.5}.staff-event time{display:block;font-size:.68rem;color:var(--muted);margin-top:5px}.staff-errors{border:1px solid #f0c4c4;background:#fff5f5;color:#922b2b;border-radius:10px;padding:12px 14px;margin-bottom:16px;font-size:.8rem}.staff-errors ul{padding-left:18px}.staff-pager{padding:15px;display:flex;justify-content:space-between;gap:12px;align-items:center;font-size:.78rem}@media(max-width:900px){.staff-grid{grid-template-columns:1fr}}@media(max-width:560px){.staff-form-grid,.staff-edit-fields{grid-template-columns:1fr}}
</style>
</head>
<body>
<div class="app">
@include('admin.partials.sidebar')
<div class="main">
<header class="topbar"><button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button><div><b>Staff &amp; permissions</b><div class="xs muted">Manage access to the foundation console</div></div><div class="top-actions"><a class="btn btn-outline btn-sm" href="{{ route('admin.dashboard') }}">Dashboard</a><form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-outline btn-sm" type="submit">Sign out</button></form></div></header>
<main class="content">
<div class="page-head staff-intro"><div><div class="crumb">Administration / Access control</div><h1>Staff &amp; permissions</h1><p>Control who can access the foundation administration system.</p></div><div class="row" style="gap:8px;flex-wrap:wrap"><span class="pill green">{{ number_format($activeCount) }} active accounts</span><span class="pill">{{ number_format($roleCount) }} super admin(s)</span></div></div>
<div class="staff-note"><strong>Access-control rules:</strong> only an active Super Administrator can create staff accounts, change roles, reset staff passwords, or deactivate accounts. At least one active Super Administrator must remain. Passwords must contain at least 4 characters. Role permissions will be enforced as each management module is added.</div>
@if(session('status'))<div class="alert success" role="status">{{ session('status') }}</div>@endif
@if($errors->any())<div class="staff-errors" role="alert"><strong>Please correct the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="staff-grid">
<section class="card">
<div class="card-head"><div><h3>Administrator accounts</h3><p>Review staff details, access roles and account status.</p></div></div>
<div class="staff-table-wrap"><table class="staff-table"><thead><tr><th>Staff member</th><th>Role</th><th>Status</th><th>Last sign-in</th></tr></thead><tbody>
@forelse($staff as $member)
<tr>
<td><b>{{ $member->name }}</b><span class="dash-sub">{{ $member->email }}</span>
@if((int)$member->id === (int)$admin->id)<span class="dash-sub">Your account</span>@endif
<details class="staff-edit"><summary>Edit account</summary>
<form method="POST" action="{{ route('admin.staff.update', $member->id) }}">@csrf @method('PUT')
<div class="staff-edit-fields">
<input name="name" aria-label="Staff name" value="{{ $member->name }}" required maxlength="120">
<input type="email" name="email" aria-label="Staff email" value="{{ $member->email }}" required maxlength="255">
<select name="role" aria-label="Staff role" required>@foreach($roles as $key=>$label)<option value="{{ $key }}" @selected($member->role === $key)>{{ $label }}</option>@endforeach</select>
<select name="is_active" aria-label="Account status" required><option value="1" @selected((bool)$member->is_active)>Active</option><option value="0" @selected(!(bool)$member->is_active)>Inactive</option></select>
<input type="password" name="password" autocomplete="new-password" placeholder="New password (optional)" minlength="4">
<input type="password" name="password_confirmation" autocomplete="new-password" placeholder="Confirm new password">
</div><p class="xs muted" style="margin:4px 0 10px">Leave both password fields empty to keep the current password.</p>
<button class="btn btn-primary btn-sm" type="submit">Save changes</button>
</form></details>
</td>
<td><span class="staff-role">{{ $roles[$member->role] ?? $member->role }}</span></td>
<td><span class="staff-status {{ $member->is_active ? 'active' : 'inactive' }}">{{ $member->is_active ? 'Active' : 'Inactive' }}</span></td>
<td>{{ $member->last_login_at ? \Illuminate\Support\Carbon::parse($member->last_login_at)->format('d M Y, H:i') : 'Never' }}</td>
</tr>
@empty<tr><td colspan="4" class="dash-empty">No staff accounts found.</td></tr>@endforelse
</tbody></table></div>
@if($staff->hasPages())<div class="staff-pager"><span>Showing {{ $staff->firstItem() }}–{{ $staff->lastItem() }} of {{ $staff->total() }}</span><div class="row" style="gap:8px">@if($staff->previousPageUrl())<a class="btn btn-outline btn-sm" href="{{ $staff->previousPageUrl() }}">Previous</a>@endif @if($staff->nextPageUrl())<a class="btn btn-outline btn-sm" href="{{ $staff->nextPageUrl() }}">Next</a>@endif</div></div>@endif
</section>
<div style="display:grid;gap:20px">
<section class="card"><div class="card-head"><div><h3>Create staff account</h3><p>Provide a unique email and secure initial password.</p></div></div><div class="card-body">
<form method="POST" action="{{ route('admin.staff.store') }}">@csrf
<div class="staff-field"><label for="new-name">Full name</label><input id="new-name" name="name" value="{{ old('name') }}" required maxlength="120" autocomplete="name"></div>
<div class="staff-field"><label for="new-email">Email address</label><input id="new-email" type="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email"></div>
<div class="staff-field"><label for="new-role">Access role</label><select id="new-role" name="role" required>@foreach($roles as $key=>$label)<option value="{{ $key }}" @selected(old('role', 'content_manager') === $key)>{{ $label }}</option>@endforeach</select><small>Assign only the access needed for this person's responsibilities.</small></div>
<div class="staff-field"><label for="new-password">Initial password</label><input id="new-password" type="password" name="password" required minlength="4" maxlength="255" autocomplete="new-password"><small>At least 4 characters. Share the initial password securely and ask the staff member to change it after sign-in.</small></div>
<div class="staff-field"><label for="new-password-confirmation">Confirm password</label><input id="new-password-confirmation" type="password" name="password_confirmation" required minlength="4" maxlength="255" autocomplete="new-password"></div>
<button class="btn btn-primary" type="submit" style="width:100%">Create staff account</button>
</form></div></section>
<section class="card"><div class="card-head"><div><h3>Recent access activity</h3><p>Recorded staff-account changes.</p></div></div><div class="card-body staff-activity">
@forelse($activity as $event)<div class="staff-event"><b>{{ str($event->action)->replace('.', ' ')->headline() }}</b><p>By {{ $event->actor_name ?? 'Deleted administrator' }}@if($event->details) · {{ collect(json_decode($event->details, true) ?: [])->map(fn($v,$k)=>str($k)->replace('_',' ')->headline().': '.(is_bool($v)?($v?'Yes':'No'):$v))->implode(' · ') }}@endif</p><time>{{ \Illuminate\Support\Carbon::parse($event->created_at)->format('d M Y, H:i') }}@if($event->ip_address) · {{ $event->ip_address }}@endif</time></div>
@empty<div class="dash-empty">No staff changes have been recorded yet.</div>@endforelse
</div></section>
</div>
</div>
<footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Access management</footer>
</main></div></div>
<script src="{{ asset('admin-static/js/admin.js') }}" defer></script>
</body></html>

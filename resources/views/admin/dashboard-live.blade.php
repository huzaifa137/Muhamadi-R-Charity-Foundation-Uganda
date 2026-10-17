<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Dashboard | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-static/css/admin.css') }}">
<script src="{{ asset('admin-static/js/admin.js') }}" defer></script>
<style>
.dash-note{display:flex;gap:12px;padding:16px 18px;margin-bottom:22px;background:#f0faf2;border:1px solid #cfe8d4;border-radius:14px;color:#395647}.dash-note strong{display:block;color:#183b29;margin-bottom:4px}.dash-note p{font-size:.82rem;line-height:1.6}
.dash-top{display:flex;align-items:flex-start;justify-content:space-between;gap:18px;flex-wrap:wrap}.live-label{padding:7px 11px;background:#f0faf2;border:1px solid #cfe8d4;border-radius:999px;color:#176638;font-size:.74rem;font-weight:800;white-space:nowrap}
.dash-table{width:100%;border-collapse:collapse}.dash-table th,.dash-table td{padding:13px 15px;text-align:left;border-bottom:1px solid var(--line);font-size:.82rem}.dash-table th{font-size:.7rem;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}.dash-table tr:last-child td{border-bottom:0}.dash-sub{display:block;color:var(--muted);font-size:.74rem;margin-top:3px}.dash-empty{padding:26px 16px;text-align:center;color:var(--muted);font-size:.85rem}.dash-modules{display:grid;gap:0}.dash-module{display:flex;justify-content:space-between;gap:12px;align-items:center;padding:13px 0;border-bottom:1px solid var(--line)}.dash-module:last-child{border-bottom:0}.dash-module b{display:block;font-size:.83rem}.dash-module small{display:block;color:var(--muted);font-size:.75rem;margin-top:3px}.dash-planned{background:#f0f1f0;color:#68736b;border-radius:999px;padding:5px 8px;font-size:.68rem;font-weight:800;white-space:nowrap}.dash-live{background:#e8f7ec;color:#176638;border-radius:999px;padding:5px 8px;font-size:.68rem;font-weight:800;white-space:nowrap}.dash-icon{width:42px;height:42px;display:grid;place-items:center;border-radius:12px;background:#e8f7ec;color:#087d3f;font-size:20px}.dash-kpi-top{display:flex;justify-content:space-between;align-items:center}.dash-kpi-num{font-size:1.9rem;font-weight:800;letter-spacing:-.04em;margin-top:12px}.dash-kpi-label{font-size:.8rem;color:var(--muted);font-weight:700;margin-top:5px}.dash-kpi-foot{font-size:.72rem;color:var(--muted);margin-top:12px}@media(max-width:650px){.dash-table th,.dash-table td{padding:11px 8px}.dash-hide-mobile{display:none}}
</style>
</head>
<body>
<div class="app">
<aside class="sidebar" id="sidebar">
<a class="side-brand" href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/images/logo.webp') }}" alt="Foundation logo"><span><b>Muhamadi R Charity</b><small>Admin Console</small></span></a>
<nav class="side-scroll">
<div class="nav-label">Overview</div><a class="nav-item active" href="{{ route('admin.dashboard') }}">▦ &nbsp; Dashboard</a>
@if(($adminRole ?? '') === 'super_admin')
<div class="nav-label">Administration</div><a class="nav-item" href="{{ route('admin.staff.index') }}">♙ &nbsp; Staff &amp; permissions</a>
@endif
<div class="nav-label">Public website</div>
<a class="nav-item" href="{{ route('home') }}" target="_blank" rel="noopener">↗ &nbsp; View website</a>
<a class="nav-item" href="{{ route('about') }}">♡ &nbsp; About Us</a>
<a class="nav-item" href="{{ route('programs') }}">◇ &nbsp; Programs</a>
<a class="nav-item" href="{{ route('impact') }}">↗ &nbsp; Impact</a>
<a class="nav-item" href="{{ route('stories') }}">▤ &nbsp; Stories</a>
<a class="nav-item" href="{{ route('gallery') }}">▧ &nbsp; Gallery</a>
<a class="nav-item" href="{{ route('contact') }}">✉ &nbsp; Contact</a>
<div class="nav-label">Coming next</div>
<div class="nav-item" aria-disabled="true">♡ &nbsp; Donations</div><div class="nav-item" aria-disabled="true">♙ &nbsp; Volunteers</div><div class="nav-item" aria-disabled="true">▥ &nbsp; Reports</div>
</nav>
<div class="side-foot"><div class="side-card"><div class="row between"><b class="small">Application</b><span class="pill green">Online</span></div><p>Foundation management dashboard</p><a href="{{ route('home') }}" target="_blank" rel="noopener">Open public website ↗</a></div></div>
</aside>
<div class="main">
<header class="topbar">
<button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu">☰</button>
<div><b>Admin Console</b><div class="xs muted">Muhamadi R Charity Foundation Uganda</div></div>
<div class="top-actions"><a class="btn btn-outline btn-sm" href="{{ route('home') }}" target="_blank" rel="noopener">View website ↗</a>
<form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-outline btn-sm" type="submit">Sign out</button></form></div>
</header>
<main class="content">
<div class="page-head dash-top"><div><div class="crumb">Overview / Dashboard</div><h1>Welcome back, {{ $adminName }}</h1><p>Current foundation website and administration overview.</p><p class="xs muted" style="margin-top:8px">Updated {{ $dashboardUpdatedAt->format('d M Y, H:i') }}</p></div><span class="live-label">● Live database figures</span></div>
<div class="dash-note"><span style="font-size:22px">ⓘ</span><div><strong>Real figures, not demo data</strong><p>These numbers come from your database and current gallery files. Donations, fundraising campaigns, volunteers and enquiries will appear after those modules and their database tables are implemented.</p></div></div>
<div class="g g-4 mb-3">
<div class="card kpi"><div class="dash-kpi-top"><span class="dash-icon">♙</span></div><div class="dash-kpi-num">{{ number_format($stats['publicUsers']) }}</div><div class="dash-kpi-label">Public accounts</div><div class="dash-kpi-foot">Registered website users</div></div>
<div class="card kpi"><div class="dash-kpi-top"><span class="dash-icon" style="background:#fff0f0;color:#b52a31">＋</span></div><div class="dash-kpi-num">{{ number_format($stats['newUsersThisMonth']) }}</div><div class="dash-kpi-label">New accounts this month</div><div class="dash-kpi-foot">Since {{ now()->startOfMonth()->format('d M Y') }}</div></div>
<div class="card kpi"><div class="dash-kpi-top"><span class="dash-icon" style="background:#edf4ff;color:#2f64ae">♧</span></div><div class="dash-kpi-num">{{ number_format($stats['activeAdmins']) }}</div><div class="dash-kpi-label">Active administrators</div><div class="dash-kpi-foot">{{ number_format($stats['totalAdmins']) }} administrator account(s) total</div></div>
<div class="card kpi"><div class="dash-kpi-top"><span class="dash-icon" style="background:#fff5e5;color:#98620a">▧</span></div><div class="dash-kpi-num">{{ number_format($stats['galleryImages']) }}</div><div class="dash-kpi-label">Gallery images</div><div class="dash-kpi-foot">Files currently in the gallery folder</div></div>
</div>
<div class="g g-21" style="margin-top:24px">
<section class="card"><div class="card-head"><div><h3>Recently registered users</h3><p>Latest public accounts recorded in the database</p></div><span class="pill green">{{ number_format($stats['publicUsers']) }} total</span></div>
@if($recentUsers->isNotEmpty())
<div class="table-wrap"><table class="dash-table"><thead><tr><th>User</th><th class="dash-hide-mobile">Registered</th></tr></thead><tbody>
@foreach($recentUsers as $user)<tr><td><b>{{ $user->name }}</b><span class="dash-sub">{{ $user->email }}</span></td><td class="dash-hide-mobile">{{ $user->created_at?->format('d M Y') ?? '—' }}</td></tr>@endforeach
</tbody></table></div>
@else<div class="dash-empty">No public accounts have registered yet.</div>@endif
</section>
<section class="card"><div class="card-head"><div><h3>Administrator activity</h3><p>Most recent successful sign-ins</p></div></div>
@if($recentAdminLogins->isNotEmpty())<div class="card-body dash-modules">
@foreach($recentAdminLogins as $login)<div class="dash-module"><div><b>{{ $login->name }}</b><small>{{ $login->email }} · {{ \Illuminate\Support\Carbon::parse($login->last_login_at)->diffForHumans() }}</small></div><span class="dash-live">Admin</span></div>@endforeach
</div>@else<div class="dash-empty">No successful sign-ins have been recorded yet.</div>@endif
</section></div>
<div class="g g-21" style="margin-top:24px">
<section class="card"><div class="card-head"><div><h3>Foundation modules</h3><p>Implementation status</p></div></div><div class="card-body dash-modules">
<div class="dash-module"><div><b>Public website &amp; gallery</b><small>Public pages and gallery are available.</small></div><span class="dash-live">Available</span></div>
<div class="dash-module"><div><b>Administrator sign-in</b><small>Active accounts and successful login timestamps.</small></div><span class="dash-live">Available</span></div>
<div class="dash-module"><div><b>Public accounts</b><small>Registration and sign-in use the users table.</small></div><span class="dash-live">Available</span></div>
<div class="dash-module"><div><b>Programs &amp; impact management</b><small>Persistent content management is next.</small></div><span class="dash-planned">Planned</span></div>
<div class="dash-module"><div><b>Donations &amp; receipts</b><small>Real records and verified payment statuses.</small></div><span class="dash-planned">Planned</span></div>
<div class="dash-module"><div><b>Volunteers &amp; enquiries</b><small>Applications and messages stored for review.</small></div><span class="dash-planned">Planned</span></div>
</div></section>
<section class="card"><div class="card-head"><div><h3>Quick actions</h3><p>Open a current website section</p></div></div><div class="card-body"><div class="quick">
<a href="{{ route('programs') }}"><span class="kpi-ic">◇</span>Review programs page</a>
<a href="{{ route('impact') }}"><span class="kpi-ic amber">↗</span>Review impact page</a>
<a href="{{ route('stories') }}"><span class="kpi-ic red">▤</span>Review stories</a>
<a href="{{ route('gallery') }}"><span class="kpi-ic blue">▧</span>Open gallery</a>
<a href="{{ route('contact') }}"><span class="kpi-ic">✉</span>Review contact page</a>
</div></div></section></div>
<footer class="xs muted" style="padding:24px 0 8px">Muhamadi R Charity Foundation Uganda · Administration dashboard</footer>
</main></div></div></body></html>

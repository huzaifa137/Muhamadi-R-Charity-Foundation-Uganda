<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>Dashboard · Admin | Muhamadi R Charity Foundation Uganda</title>
<link rel="icon" href="{{ asset('assets/images/favicon.webp') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
<script src="{{ asset('admin/js/charts.js') }}"></script>
<script src="{{ asset('admin/js/data.js') }}"></script>
<script src="{{ asset('admin/js/admin.js') }}"></script>

</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true"><symbol id="i-grid" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></symbol><symbol id="i-home" viewBox="0 0 24 24"><path d="M3 11l9-8 9 8v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/></symbol><symbol id="i-file" viewBox="0 0 24 24"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6M8 13h8M8 17h8"/></symbol><symbol id="i-heart" viewBox="0 0 24 24"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/></symbol><symbol id="i-chart" viewBox="0 0 24 24"><path d="M3 3v18h18M7 15v3M12 10v8M17 6v12"/></symbol><symbol id="i-image" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></symbol><symbol id="i-users" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/></symbol><symbol id="i-user" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></symbol><symbol id="i-mail" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></symbol><symbol id="i-settings" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1.1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></symbol><symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3"/></symbol><symbol id="i-bell" viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9M13.7 21a2 2 0 0 1-3.4 0"/></symbol><symbol id="i-plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol><symbol id="i-edit" viewBox="0 0 24 24"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></symbol><symbol id="i-trash" viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v6M14 11v6"/></symbol><symbol id="i-eye" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></symbol><symbol id="i-upload" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></symbol><symbol id="i-download" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></symbol><symbol id="i-check" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></symbol><symbol id="i-x" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></symbol><symbol id="i-up-right" viewBox="0 0 24 24"><path d="M7 17L17 7M7 7h10v10"/></symbol><symbol id="i-down-right" viewBox="0 0 24 24"><path d="M7 7l10 10M17 7v10H7"/></symbol><symbol id="i-trend" viewBox="0 0 24 24"><path d="M23 6l-9.5 9.5-5-5L1 18M17 6h6v6"/></symbol><symbol id="i-globe" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20z"/></symbol><symbol id="i-calendar" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></symbol><symbol id="i-layers" viewBox="0 0 24 24"><path d="M12 2l10 5-10 5L2 7z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></symbol><symbol id="i-target" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></symbol><symbol id="i-briefcase" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></symbol><symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></symbol><symbol id="i-menu" viewBox="0 0 24 24"><path d="M3 6h18M3 12h18M3 18h18"/></symbol><symbol id="i-logout" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></symbol><symbol id="i-star" viewBox="0 0 24 24"><path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1z"/></symbol><symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></symbol><symbol id="i-filter" viewBox="0 0 24 24"><path d="M22 3H2l8 9.5V19l4 2v-8.5z"/></symbol><symbol id="i-more" viewBox="0 0 24 24"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></symbol><symbol id="i-external" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></symbol><symbol id="i-save" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8M7 3v5h8"/></symbol><symbol id="i-lock" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></symbol><symbol id="i-phone" viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></symbol><symbol id="i-pin" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></symbol><symbol id="i-wallet" viewBox="0 0 24 24"><path d="M20 12V8H6a2 2 0 0 1 0-4h12v4M4 6v12a2 2 0 0 0 2 2h14v-4"/><path d="M18 12a2 2 0 0 0 0 4h4v-4z"/></symbol><symbol id="i-link" viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.7M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.7"/></symbol><symbol id="i-chev-down" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></symbol><symbol id="i-chev-right" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></symbol><symbol id="i-help" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3M12 17h.01"/></symbol><symbol id="i-cloud" viewBox="0 0 24 24"><path d="M20 17.6A5 5 0 0 0 18 8h-1.3A8 8 0 1 0 4 16.3M12 12v9M16 16l-4-4-4 4"/></symbol><symbol id="i-grip" viewBox="0 0 24 24"><circle cx="9" cy="6" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="18" r="1"/><circle cx="15" cy="6" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="18" r="1"/></symbol><symbol id="i-send" viewBox="0 0 24 24"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/></symbol><symbol id="i-bold" viewBox="0 0 24 24"><path d="M6 4h8a4 4 0 0 1 0 8H6zM6 12h9a4 4 0 0 1 0 8H6z"/></symbol><symbol id="i-italic" viewBox="0 0 24 24"><path d="M19 4h-9M14 20H5M15 4L9 20"/></symbol><symbol id="i-list" viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></symbol><symbol id="i-quote" viewBox="0 0 24 24"><path d="M3 21c3 0 7-1 7-8V5a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4M15 21c3 0 7-1 7-8V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4"/></symbol><symbol id="i-refresh" viewBox="0 0 24 24"><path d="M23 4v6h-6M1 20v-6h6"/><path d="M3.5 9a9 9 0 0 1 14.9-3.4L23 10M1 14l4.6 4.4A9 9 0 0 0 20.5 15"/></symbol><symbol id="i-print" viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></symbol><symbol id="i-megaphone" viewBox="0 0 24 24"><path d="M3 11v2a1 1 0 0 0 1 1h3l8 5V5L7 10H4a1 1 0 0 0-1 1zM19 8a5 5 0 0 1 0 8"/></symbol><symbol id="i-check-circle" viewBox="0 0 24 24"><path d="M22 11.1V12a10 10 0 1 1-5.9-9.1"/><path d="M22 4L12 14l-3-3"/></symbol><symbol id="i-alert" viewBox="0 0 24 24"><path d="M10.3 3.9L1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0zM12 9v4M12 17h.01"/></symbol><symbol id="i-tag" viewBox="0 0 24 24"><path d="M20.6 13.4l-7.2 7.2a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="7" cy="7" r="1.5"/></symbol><symbol id="i-map" viewBox="0 0 24 24"><path d="M1 6v16l7-4 8 4 7-4V2l-7 4-8-4z"/><path d="M8 2v16M16 6v16"/></symbol><symbol id="i-key" viewBox="0 0 24 24"><circle cx="7.5" cy="15.5" r="5.5"/><path d="M21 2l-9.6 9.6M15.5 7.5l3 3L22 7l-3-3"/></symbol><symbol id="i-palette" viewBox="0 0 24 24"><circle cx="13.5" cy="6.5" r="1"/><circle cx="17.5" cy="10.5" r="1"/><circle cx="8.5" cy="7.5" r="1"/><circle cx="6.5" cy="12.5" r="1"/><path d="M12 2a10 10 0 0 0 0 20c1.1 0 2-.9 2-2 0-.5-.2-1-.5-1.3-.3-.4-.5-.8-.5-1.3 0-1.1.9-2 2-2h2.4A5.6 5.6 0 0 0 22 10.1C22 5.6 17.5 2 12 2z"/></symbol></svg>
<div class="app">
<aside class="sidebar" id="sidebar">
  <a class="side-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.webp') }}" alt="Foundation logo"><span><b>Muhamadi R Charity</b><small>Admin Console</small></span></a>
  <nav class="side-scroll">
<div class="nav-label">Overview</div>
<a class="nav-item active" href="{{ route('home') }}"><svg class="i"><use href="#i-grid"/></svg>Dashboard</a>
<a class="nav-item" href="analytics.html"><svg class="i"><use href="#i-chart"/></svg>Analytics</a>
<div class="nav-label">Website content</div>
<a class="nav-item" href="homepage.html"><svg class="i"><use href="#i-home"/></svg>Homepage</a>
<a class="nav-item" href="{{ route('about') }}"><svg class="i"><use href="#i-heart"/></svg>About Us</a>
<a class="nav-item" href="{{ route('programs') }}"><svg class="i"><use href="#i-layers"/></svg>What We Do</a>
<a class="nav-item" href="{{ route('impact') }}"><svg class="i"><use href="#i-trend"/></svg>Our Impact</a>
<a class="nav-item" href="{{ route('stories') }}"><svg class="i"><use href="#i-file"/></svg>Stories<span class="badge soft">2</span></a>
<a class="nav-item" href="{{ route('gallery') }}"><svg class="i"><use href="#i-image"/></svg>Gallery & Media</a>
<a class="nav-item" href="team.html"><svg class="i"><use href="#i-users"/></svg>Team</a>
<div class="nav-label">Support & engagement</div>
<a class="nav-item" href="donations.html"><svg class="i"><use href="#i-wallet"/></svg>Donations</a>
<a class="nav-item" href="campaigns.html"><svg class="i"><use href="#i-target"/></svg>Campaigns</a>
<a class="nav-item" href="volunteers.html"><svg class="i"><use href="#i-user"/></svg>Volunteers<span class="badge ">2</span></a>
<a class="nav-item" href="partners.html"><svg class="i"><use href="#i-briefcase"/></svg>Partnerships</a>
<a class="nav-item" href="messages.html"><svg class="i"><use href="#i-mail"/></svg>Messages<span class="badge ">3</span></a>
<div class="nav-label">Administration</div>
<a class="nav-item" href="settings.html"><svg class="i"><use href="#i-settings"/></svg>Site Settings</a>
<a class="nav-item" href="users.html"><svg class="i"><use href="#i-shield"/></svg>Users & Roles</a>
  </nav>
  <div class="side-foot"><div class="side-card">
    <div class="row between"><b class="small">Website status</b><span class="pill green" style="background:rgba(140,197,64,.18);color:#b8efbd">Live</span></div>
    <div class="bar"><i style="width:68%"></i></div>
    <p>Content completeness 68% · 6 placeholders left</p>
    <a href="../index.html" target="_blank" rel="noopener">View live website <svg class="i i-sm"><use href="#i-external"/></svg></a>
  </div></div>
</aside>
<div class="main">
  <header class="topbar">
    <button class="icon-btn menu-btn" data-nav-toggle aria-label="Open menu"><svg class="i"><use href="#i-menu"/></svg></button>
    <label class="search"><svg class="i i-sm"><use href="#i-search"/></svg><input type="search" placeholder="Search donors, stories, messages…" aria-label="Search"><kbd>Ctrl K</kbd></label>
    <div class="top-actions">
      <a class="btn btn-outline btn-sm" href="../index.html" target="_blank" rel="noopener"><svg class="i i-sm"><use href="#i-external"/></svg><span class="btn-label-hide">View site</span></a>
      <button class="btn btn-primary btn-sm" data-publish><svg class="i i-sm"><use href="#i-cloud"/></svg><span class="btn-label-hide">Publish changes</span></button>
      <div class="dropdown">
        <button class="icon-btn" data-dd aria-label="Notifications"><svg class="i"><use href="#i-bell"/></svg><span class="dot"></span></button>
        <div class="menu">
          <div class="menu-head">Notifications <a class="link" href="messages.html">View all</a></div>
          <div class="notif"><span class="nic"><svg class="i i-sm"><use href="#i-wallet"/></svg></span><div><b>New donation · UGX 250,000</b><span>Aisha Nakato · 2h ago</span></div></div>
          <div class="notif"><span class="nic"><svg class="i i-sm"><use href="#i-mail"/></svg></span><div><b>3 unread messages</b><span>Partnership, volunteer, donation</span></div></div>
          <div class="notif"><span class="nic"><svg class="i i-sm"><use href="#i-user"/></svg></span><div><b>2 volunteer applications</b><span>Awaiting screening</span></div></div>
          <div class="notif"><span class="nic"><svg class="i i-sm"><use href="#i-alert"/></svg></span><div><b>6 content placeholders</b><span>Contact &amp; donation details need verifying</span></div></div>
        </div>
      </div>
      <div class="dropdown">
        <button class="profile" data-dd><span class="avatar">MR</span><div><b>Muhamadi R.</b><small>Super Admin</small></div><svg class="i i-sm"><use href="#i-chev-down"/></svg></button>
        <div class="menu sm">
          <a href="users.html"><svg class="i i-sm"><use href="#i-user"/></svg>My profile</a>
          <a href="settings.html"><svg class="i i-sm"><use href="#i-settings"/></svg>Site settings</a>
          <a href="users.html#security"><svg class="i i-sm"><use href="#i-lock"/></svg>Security</a>
          <a href="{{ route('admin.login') }}" style="color:var(--red);border-top:1px solid var(--line)"><svg class="i i-sm"><use href="#i-logout"/></svg>Sign out</a>
        </div>
      </div>
    </div>
  </header>
  <main class="content">

<div class="page-head">
  <div><div class="crumb">Overview</div><h1>Welcome back, Muhamadi 👋</h1><p>Here is what is happening across the foundation's website, donations and community engagement today.</p></div>
  <div class="page-actions">
    <select class="select-sm" aria-label="Date range"><option>Last 12 months</option><option>Last 30 days</option><option>This quarter</option></select>
    <button class="btn btn-outline btn-sm" onclick="UI.toast('Report export started (demo)')"><svg class="i i-sm"><use href="#i-download"/></svg>Export report</button>
    <a class="btn btn-primary btn-sm" href="{{ route('stories') }}"><svg class="i i-sm"><use href="#i-plus"/></svg>New story</a>
  </div>
</div>

<!-- KPI row -->
<div class="g g-4 mb-3">
  <div class="card kpi"><div class="kpi-top"><span class="kpi-ic"><svg class="i i-lg"><use href="#i-wallet"/></svg></span><div id="sp1"></div></div><div class="kpi-label">Total donations (12 mo)</div><div class="kpi-value">UGX 49.6M</div><div class="kpi-foot"><span class="delta"><svg class="i i-sm"><use href="#i-up-right"/></svg>18.4%</span><span class="xs muted">vs previous year</span></div></div>
  <div class="card kpi"><div class="kpi-top"><span class="kpi-ic red"><svg class="i i-lg"><use href="#i-heart"/></svg></span><div id="sp2"></div></div><div class="kpi-label">Active donors</div><div class="kpi-value">312</div><div class="kpi-foot"><span class="delta"><svg class="i i-sm"><use href="#i-up-right"/></svg>9.2%</span><span class="xs muted">38 new this month</span></div></div>
  <div class="card kpi"><div class="kpi-top"><span class="kpi-ic blue"><svg class="i i-lg"><use href="#i-globe"/></svg></span><div id="sp3"></div></div><div class="kpi-label">Website visitors (30 days)</div><div class="kpi-value">12,400</div><div class="kpi-foot"><span class="delta"><svg class="i i-sm"><use href="#i-up-right"/></svg>24.1%</span><span class="xs muted">62% on mobile</span></div></div>
  <div class="card kpi"><div class="kpi-top"><span class="kpi-ic amber"><svg class="i i-lg"><use href="#i-mail"/></svg></span><div id="sp4"></div></div><div class="kpi-label">Unread messages</div><div class="kpi-value">3</div><div class="kpi-foot"><span class="delta down"><svg class="i i-sm"><use href="#i-down-right"/></svg>2 more than avg</span><span class="xs muted">Avg reply 4h</span></div></div>
</div>

<!-- Donations trend + purpose -->
<div class="g g-21 mb-3">
  <div class="card">
    <div class="card-head"><div><h3>Donations over time</h3><p>Received contributions in UGX, compared with the previous period</p></div>
      <div class="chips" data-single id="range"><button class="chip" data-r="d">14 days</button><button class="chip" data-r="w">12 weeks</button><button class="chip active" data-r="m">12 months</button></div></div>
    <div class="card-body"><div id="ch-donations"></div><div class="legend-inline mt-1"><span><i style="background:#087d3f"></i>This period</span><span><i style="background:#8cc540"></i>Previous period</span></div></div>
  </div>
  <div class="card">
    <div class="card-head"><div><h3>Donations by purpose</h3><p>Where supporters direct their giving</p></div></div>
    <div class="card-body"><div id="ch-purpose"></div></div>
  </div>
</div>

<!-- Impact band: figures shown on website -->
<div class="card mb-3">
  <div class="card-head"><div><h3>Impact figures shown on the website</h3><p>Progress against the targets displayed on the Home and Our Impact pages</p></div><a class="link" href="{{ route('impact') }}">Manage impact data <svg class="i i-sm"><use href="#i-chev-right"/></svg></a></div>
  <div class="card-body"><div class="g g-4" id="impact-rings"></div></div>
</div>

<!-- Traffic + campaigns -->
<div class="g g-21 mb-3">
  <div class="card">
    <div class="card-head"><div><h3>Website traffic</h3><p>Visitors and page views · last 30 days</p></div><a class="link" href="analytics.html">Full analytics <svg class="i i-sm"><use href="#i-chev-right"/></svg></a></div>
    <div class="card-body"><div id="ch-traffic"></div><div class="legend-inline mt-1"><span><i style="background:#3bb64b"></i>Visitors</span><span><i style="background:#cfe6d2"></i>Page views</span></div></div>
  </div>
  <div class="card">
    <div class="card-head"><div><h3>Active campaigns</h3><p>Fundraising progress</p></div><a class="link" href="campaigns.html">All</a></div>
    <div class="card-body" id="camp-list"></div>
  </div>
</div>

<!-- Tables & feeds -->
<div class="g g-21 mb-3">
  <div class="card">
    <div class="card-head"><div><h3>Recent donations</h3><p>Latest contributions across all channels</p></div><a class="link" href="donations.html">View all <svg class="i i-sm"><use href="#i-chev-right"/></svg></a></div>
    <div class="table-wrap" style="margin-top:14px"><table class="table"><thead><tr><th>Donor</th><th>Purpose</th><th>Date</th><th>Amount</th><th>Status</th></tr></thead><tbody id="don-body"></tbody></table></div>
  </div>
  <div class="card">
    <div class="card-head"><div><h3>Recent activity</h3><p>Across the whole site</p></div></div>
    <div class="card-body"><div class="feed" id="feed"></div></div>
  </div>
</div>

<!-- Bottom row: content health, to-do, quick actions -->
<div class="g g-3">
  <div class="card">
    <div class="card-head"><div><h3>Content health</h3><p>Placeholders still showing on the live site</p></div><div id="ring-health" style="width:64px;height:64px"></div></div>
    <div class="card-body">
      <div class="check-row"><span class="st warn"><svg class="i"><use href="#i-alert"/></svg></span>Contact phone numbers &amp; emails<a class="link" href="settings.html#contact">Fix</a></div>
      <div class="check-row"><span class="st warn"><svg class="i"><use href="#i-alert"/></svg></span>Physical office address &amp; map<a class="link" href="settings.html#contact">Fix</a></div>
      <div class="check-row"><span class="st warn"><svg class="i"><use href="#i-alert"/></svg></span>Verified donation details<a class="link" href="donations.html#channels">Fix</a></div>
      <div class="check-row"><span class="st warn"><svg class="i"><use href="#i-alert"/></svg></span>Official story dates<a class="link" href="{{ route('stories') }}">Fix</a></div>
      <div class="check-row"><span class="st warn"><svg class="i"><use href="#i-alert"/></svg></span>Approved testimonials<a class="link" href="impact.html#testimonials">Fix</a></div>
      <div class="check-row"><span class="st"><svg class="i"><use href="#i-check"/></svg></span>Mission, vision &amp; values</div>
      <div class="check-row"><span class="st"><svg class="i"><use href="#i-check"/></svg></span>Gallery (101 photographs)</div>
    </div>
  </div>
  <div class="card">
    <div class="card-head"><div><h3>Needs your attention</h3><p>Pending items across the dashboard</p></div></div>
    <div class="card-body">
      <a class="todo" href="messages.html"><span class="kpi-ic amber" style="width:38px;height:38px;border-radius:11px"><svg class="i"><use href="#i-mail"/></svg></span><div><b class="small">Reply to messages</b><div class="xs muted">Partnership, volunteer, donation</div></div><span class="n">3</span></a>
      <a class="todo" href="volunteers.html"><span class="kpi-ic" style="width:38px;height:38px;border-radius:11px"><svg class="i"><use href="#i-user"/></svg></span><div><b class="small">Screen volunteer applications</b><div class="xs muted">New this week</div></div><span class="n">2</span></a>
      <a class="todo" href="donations.html"><span class="kpi-ic blue" style="width:38px;height:38px;border-radius:11px"><svg class="i"><use href="#i-wallet"/></svg></span><div><b class="small">Confirm pending donations</b><div class="xs muted">Mobile Money awaiting match</div></div><span class="n">1</span></a>
      <a class="todo" href="{{ route('stories') }}"><span class="kpi-ic red" style="width:38px;height:38px;border-radius:11px"><svg class="i"><use href="#i-file"/></svg></span><div><b class="small">Finish draft stories</b><div class="xs muted">1 draft · 1 scheduled</div></div><span class="n">2</span></a>
      <a class="todo" href="partners.html"><span class="kpi-ic" style="width:38px;height:38px;border-radius:11px"><svg class="i"><use href="#i-briefcase"/></svg></span><div><b class="small">Follow up partnership leads</b><div class="xs muted">In discussion</div></div><span class="n">2</span></a>
    </div>
  </div>
  <div class="card">
    <div class="card-head"><div><h3>Quick actions</h3><p>Jump straight to common tasks</p></div></div>
    <div class="card-body">
      <div class="quick">
        <a href="{{ route('stories') }}"><span class="kpi-ic"><svg class="i"><use href="#i-file"/></svg></span>Publish a story</a>
        <a href="{{ route('gallery') }}"><span class="kpi-ic blue"><svg class="i"><use href="#i-upload"/></svg></span>Upload photos</a>
        <a href="campaigns.html"><span class="kpi-ic red"><svg class="i"><use href="#i-target"/></svg></span>Start a campaign</a>
        <a href="{{ route('impact') }}"><span class="kpi-ic amber"><svg class="i"><use href="#i-trend"/></svg></span>Update impact</a>
        <a href="homepage.html"><span class="kpi-ic"><svg class="i"><use href="#i-home"/></svg></span>Edit homepage</a>
        <a href="settings.html"><span class="kpi-ic blue"><svg class="i"><use href="#i-settings"/></svg></span>Site settings</a>
      </div>
    </div>
  </div>
</div>

<script>document.addEventListener('DOMContentLoaded',function(){
  const D = DB, C = Charts.COL;
  Charts.spark('#sp1', D.donationsMonthly, C.deep); Charts.spark('#sp2', [210,220,236,244,251,262,270,281,290,298,305,312], C.red);
  Charts.spark('#sp3', D.traffic30.slice(-14), C.blue); Charts.spark('#sp4', [1,4,2,6,3,5,2,3,7,4,3,3], C.amber);

  const ranges = {
    m: { labels: D.months, a: D.donationsMonthly, b: D.donationsPrev },
    w: { labels: Array.from({length:12},(_,i)=>'W'+(i+1)), a: D.donationsWeekly, b: D.donationsWeekly.map(v=>Math.round(v*.78)) },
    d: { labels: Array.from({length:14},(_,i)=>'Oct '+(i-3+1>0?i-2:30+i-2)), a: D.donationsDaily, b: D.donationsDaily.map((v,i)=>Math.round(v*(.6+((i*7)%5)/10))) }
  };
  ranges.d.labels = ['Sep 27','28','29','30','Oct 1','2','3','4','5','6','7','8','9','10'];
  const draw = k => Charts.line('#ch-donations', { height: 300, labels: ranges[k].labels, format: Charts.fmtN, tipFormat: v => UI.ugx(v),
    series: [{ name: 'This period', data: ranges[k].a, color: C.deep }, { name: 'Previous period', data: ranges[k].b, color: C.lime, fill: false, dash: true }] });
  draw('m');
  document.querySelectorAll('#range .chip').forEach(c => c.addEventListener('click', () => draw(c.dataset.r)));

  Charts.donut('#ch-purpose', { items: D.purposes.map((p,i)=>({label:p.label,value:p.value})), center: { value: '49.6M', label: 'UGX total' }, tipFormat: v => UI.ugx(v) });

  const targets = [['People reached', 1000, 1000, '1000+', C.deep], ['Families supported', 400, 400, '400+', C.green], ['Communities served', 500, 500, '500+', C.lime], ['Projects / initiatives', 10, 10, '10+', C.amber]];
  document.getElementById('impact-rings').innerHTML = targets.map((t,i)=>`<div class="row" style="gap:16px"><div id="rg${i}"></div><div><b style="font-size:1.35rem;letter-spacing:-.03em">${t[3]}</b><div class="small muted strong">${t[0]}</div><div class="xs text-green strong mt-1">Verified · shown on website</div></div></div>`).join('');
  targets.forEach((t,i)=>Charts.ring('#rg'+i, Math.round(t[1]/t[2]*100), t[4], '100%'));

  Charts.bar('#ch-traffic', { height: 280, labels: D.traffic30.map((_,i)=>i<20?'Sep '+(i+11):'Oct '+(i-19)), stacked: false,
    series: [{ name: 'Visitors', data: D.traffic30, color: C.green }, { name: 'Page views', data: D.pageviews30, color: '#cfe6d2' }] });

  document.getElementById('camp-list').innerHTML = D.campaigns.filter(c=>c.status==='Live'||c.status==='Completed').slice(0,3).map(c=>{ const p=Math.round(c.raised/c.goal*100); return `<div class="mb-2"><div class="row between small strong"><span>${c.title}</span><span class="text-green">${p}%</span></div><div class="progress mt-1"><i style="width:${p}%"></i></div><div class="xs muted mt-1">${UI.ugxShort(c.raised)} of ${UI.ugxShort(c.goal)} · ${c.donors} donors</div></div>`; }).join('');

  document.getElementById('don-body').innerHTML = D.donations.slice(0,6).map(d=>`<tr><td><div class="cell-user">${UI.avatar(d.donor==='Anonymous'?'A N':d.donor)}<div><b>${d.donor}</b><span>${d.id}</span></div></div></td><td>${d.purpose}</td><td class="muted">${UI.date(d.date)}</td><td class="num">${UI.ugx(d.amount)}</td><td>${UI.pill(d.status)}</td></tr>`).join('');

  document.getElementById('feed').innerHTML = D.activity.slice(0,6).map(a=>`<div class="feed-item"><span class="feed-dot ${a.tone}">${UI.icon(a.ic)}</span><div class="grow"><b>${a.t}</b><span>${a.s} · ${a.when}</span></div></div>`).join('');
  Charts.ring('#ring-health', 68, C.green);
});</script>

  </main>
</div>
</div>
<div class="overlay" id="confirm-modal"><div class="modal sm"><div class="modal-head"><div><h3 id="confirm-title">Are you sure?</h3><p id="confirm-text">This action cannot be undone.</p></div></div><div class="modal-foot"><button class="btn btn-outline btn-sm" data-close>Cancel</button><button class="btn btn-danger btn-sm" id="confirm-ok">Delete</button></div></div></div>
</body>
</html>

@php
    $sidebarAdmin = \Illuminate\Support\Facades\DB::table('admins')->where('id', session('charity_admin_id'))->where('is_active', true)->first();
    $sidebarRole = $sidebarAdmin->role ?? '';
    $canManageContent = in_array($sidebarRole, ['super_admin', 'administrator', 'content_manager'], true);
    $canManageFinance = in_array($sidebarRole, ['super_admin', 'administrator', 'finance_manager'], true);
    $canManageRecords = in_array($sidebarRole, ['super_admin', 'administrator', 'content_manager', 'finance_manager'], true);
    $activeOperation = request()->route('module');
    $canViewReports = in_array($sidebarRole, ['super_admin', 'administrator', 'finance_manager', 'content_manager'], true);
    $canManageSettings = in_array($sidebarRole, ['super_admin', 'administrator'], true);
@endphp
<aside class="sidebar" id="sidebar">
    <a class="side-brand" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('assets/images/logo.webp') }}" alt="Foundation logo">
        <span><b>Muhamadi R Charity</b><small>Admin Console</small></span>
    </a>
    <nav class="side-scroll" aria-label="Admin navigation">
        <div class="nav-label">Workspace</div>
        <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">▦ &nbsp; Dashboard</a>

        @if($canManageContent)
            <div class="nav-label">Content management</div>
            <a class="nav-item {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}" href="{{ route('admin.programs.index') }}">◇ &nbsp; Programs</a>
            <a class="nav-item {{ request()->routeIs('admin.about.*') ? 'active' : '' }}" href="{{ route('admin.about.edit') }}">♡ &nbsp; About page</a>
            <a class="nav-item {{ request()->routeIs('admin.site-pages.*') ? 'active' : '' }}" href="{{ route('admin.site-pages.index') }}">▤ &nbsp; Website pages</a>
        @endif

        @if($canManageRecords || $canManageFinance)
            <div class="nav-label">Foundation operations</div>
            @if($canManageFinance)
                <a class="nav-item {{ $activeOperation === 'donations' ? 'active' : '' }}" href="{{ route('admin.operations.index', 'donations') }}">♡ &nbsp; Donations</a>
            @endif
            @if($canManageContent)
                <a class="nav-item {{ $activeOperation === 'impact' ? 'active' : '' }}" href="{{ route('admin.operations.index', 'impact') }}">◈ &nbsp; Projects & impact</a>
                <a class="nav-item {{ $activeOperation === 'stories' ? 'active' : '' }}" href="{{ route('admin.operations.index', 'stories') }}">▣ &nbsp; Stories & news</a>
                <a class="nav-item {{ $activeOperation === 'gallery' ? 'active' : '' }}" href="{{ route('admin.operations.index', 'gallery') }}">▧ &nbsp; Gallery</a>
            @endif
            @if($canManageRecords)
                <a class="nav-item {{ $activeOperation === 'volunteers' ? 'active' : '' }}" href="{{ route('admin.operations.index', 'volunteers') }}">♧ &nbsp; Volunteers</a>
                <a class="nav-item {{ $activeOperation === 'enquiries' ? 'active' : '' }}" href="{{ route('admin.operations.index', 'enquiries') }}">✉ &nbsp; Contact enquiries</a>
            @endif
        @endif

        @if($canViewReports)
            <div class="nav-label">Insights</div>
            <a class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">▤ &nbsp; Reports &amp; exports</a>
        @endif

        @if($canManageSettings)
            <div class="nav-label">Administration</div>
            <a class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">⚙ &nbsp; Foundation settings</a>
            <a class="nav-item {{ request()->routeIs('admin.activity-log.*') ? 'active' : '' }}" href="{{ route('admin.activity-log.index') }}">◷ &nbsp; Activity log</a>
            <a class="nav-item {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" href="{{ route('admin.staff.index') }}">♙ &nbsp; Staff & permissions</a>
        @endif

        <div class="nav-label">Public website</div>
        <a class="nav-item" href="{{ route('home') }}" target="_blank" rel="noopener">↗ &nbsp; View website</a>
        <a class="nav-item" href="{{ route('contact') }}" target="_blank" rel="noopener">✉ &nbsp; Public contact page</a>
    </nav>
    <div class="side-foot">
        <div class="side-card">
            <div class="row between"><b class="small">Foundation workspace</b><span class="pill green">Active</span></div>
            <p>Navigate between sections from this menu. Your access is determined by your administrator role.</p>
        </div>
    </div>
</aside>
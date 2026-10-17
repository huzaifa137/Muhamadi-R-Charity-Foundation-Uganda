<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $admin = DB::table('admins')
            ->where('id', session('charity_admin_id'))
            ->where('is_active', true)
            ->first();

        abort_unless($admin, 403, 'An active administrator sign-in is required.');

        $galleryDirectory = public_path('assets/images/gallery');
        $galleryFiles = is_dir($galleryDirectory)
            ? (glob($galleryDirectory . DIRECTORY_SEPARATOR . '*') ?: [])
            : [];

        $galleryImageCount = count(array_filter($galleryFiles, 'is_file')) + DB::table('gallery_items')->count();

        $recentUsers = User::query()
            ->latest('created_at')
            ->limit(6)
            ->get(['id', 'name', 'email', 'created_at']);

        $recentAdminLogins = DB::table('admins')
            ->whereNotNull('last_login_at')
            ->orderByDesc('last_login_at')
            ->limit(6)
            ->get(['id', 'name', 'email', 'last_login_at']);

        return view('admin.dashboard-live', [
            'adminName' => $admin->name,
            'adminRole' => $admin->role,
            'stats' => [
                'publicUsers' => User::query()->count(),
                'newUsersThisMonth' => User::query()
                    ->where('created_at', '>=', now()->startOfMonth())
                    ->count(),
                'activeAdmins' => DB::table('admins')->where('is_active', true)->count(),
                'totalAdmins' => DB::table('admins')->count(),
                'galleryImages' => $galleryImageCount,
                'donations' => DB::table('donations')->count(),
                'pendingDonations' => DB::table('donations')->where('payment_status', 'pending')->count(),
                'volunteerApplications' => DB::table('volunteer_applications')->whereIn('status', ['new', 'reviewing'])->count(),
                'openEnquiries' => DB::table('contact_enquiries')->whereIn('status', ['new', 'in_progress'])->count(),
            ],
            'recentUsers' => $recentUsers,
            'recentAdminLogins' => $recentAdminLogins,
            'dashboardUpdatedAt' => now(),
        ]);
    }
}

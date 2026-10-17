<?php

namespace App\\Http\\Controllers\\Admin;

use App\\Http\\Controllers\\Controller;
use App\\Models\\User;
use Illuminate\\Support\\Facades\\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $adminId = session('charity_admin_id');

        $admin = DB::table('admins')
            ->where('id', $adminId)
            ->where('is_active', true)
            ->first();

        abort_unless($admin, 403, 'An active administrator sign-in is required.');

        $galleryDirectory = public_path('assets/images/gallery');
        $galleryFiles = is_dir($galleryDirectory)
            ? (glob($galleryDirectory . DIRECTORY_SEPARATOR . '*') ?: [])
            : [];

        $galleryImageCount = count(array_filter($galleryFiles, 'is_file'));

        $recentUsers = User::query()
            ->latest('created_at')
            ->limit(6)
            ->get(['id', 'name', 'email', 'created_at']);

        $recentAdminLogins = DB::table('admins')
            ->whereNotNull('last_login_at')
            ->orderByDesc('last_login_at')
            ->limit(6)
            ->get(['id', 'name', 'email', 'last_login_at']);

        return view('admin.dashboard', [
            'adminName' => $admin->name,
            'adminInitials' => collect(preg_split('/\\s+/', trim($admin->name)) ?: [])
                ->filter()
                ->take(2)
                ->map(fn (string $part) => mb_strtoupper(mb_substr($part, 0, 1)))
                ->implode(''),
            'stats' => [
                'publicUsers' => User::query()->count(),
                'newUsersThisMonth' => User::query()
                    ->where('created_at', '>=', now()->startOfMonth())
                    ->count(),
                'activeAdmins' => DB::table('admins')->where('is_active', true)->count(),
                'totalAdmins' => DB::table('admins')->count(),
                'galleryImages' => $galleryImageCount,
            ],
            'recentUsers' => $recentUsers,
            'recentAdminLogins' => $recentAdminLogins,
            'dashboardUpdatedAt' => now(),
        ]);
    }
}

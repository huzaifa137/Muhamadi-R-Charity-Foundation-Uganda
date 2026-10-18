<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Single gatekeeper for every protected /admin route.
 *
 * It requires a signed-in, still-active administrator. Controllers keep their own
 * role checks (defence in depth), but a missing check can no longer expose a page
 * to signed-out visitors.
 */
class EnsureAdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminId = $request->session()->get('charity_admin_id');

        $admin = $adminId
            ? DB::table('admins')->where('id', $adminId)->where('is_active', true)->first()
            : null;

        if (!$admin) {
            $request->session()->forget(['charity_admin_id', 'charity_admin_name']);

            return redirect()->guest(route('admin.login'))
                ->with('status', 'Please sign in to continue.');
        }

        $request->attributes->set('admin', $admin);

        $response = $next($request);

        // Stop browsers showing cached admin pages after sign-out (Back button).
        $response->headers->set('Cache-Control', 'no-store, private');

        return $response;
    }
}

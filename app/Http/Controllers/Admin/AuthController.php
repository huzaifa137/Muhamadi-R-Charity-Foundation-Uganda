<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        $key = 'charity-admin-login:' . strtolower($credentials['email']) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages(['email' => 'Too many sign-in attempts. Please wait a minute and try again.']);
        }

        $admin = DB::table('admins')->where('email', strtolower($credentials['email']))->where('is_active', true)->first();
        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            RateLimiter::hit($key, 60);
            throw ValidationException::withMessages(['email' => 'The supplied credentials are invalid.']);
        }

        RateLimiter::clear($key);
        $request->session()->regenerate();
        $request->session()->put('charity_admin_id', $admin->id);
        $request->session()->put('charity_admin_name', $admin->name);
        DB::table('admins')->where('id', $admin->id)->update(['last_login_at' => now(), 'updated_at' => now()]);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['charity_admin_id', 'charity_admin_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('status', 'You have been signed out.');
    }
}

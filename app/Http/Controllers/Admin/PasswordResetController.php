<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminPasswordResetMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class PasswordResetController extends Controller
{
    private const EXPIRY_MINUTES = 60;

    public function showForgot(): View
    {
        return view('admin.auth.forgot-password');
    }

    public function sendLink(Request $request): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email', 'max:255']]);
        $email = mb_strtolower($data['email']);

        $admin = DB::table('admins')->where('email', $email)->where('is_active', true)->first();

        if ($admin) {
            $token = Str::random(64);

            DB::table('admin_password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                ['token' => hash('sha256', $token), 'created_at' => now()]
            );

            $url = route('admin.password.reset', ['token' => $token, 'email' => $email]);

            try {
                Mail::to($email)->send(new AdminPasswordResetMail($admin->name, $url, self::EXPIRY_MINUTES));
            } catch (Throwable $exception) {
                Log::warning('Administrator password reset email failed.', ['error' => $exception->getMessage()]);
            }

            $this->log($admin->id, 'admin.password_reset_requested', $request);
        }

        // Same answer whether or not the address exists, so emails cannot be probed.
        return back()->with('status', 'If that email belongs to an active administrator account, a password reset link has been sent.');
    }

    public function showReset(Request $request, string $token): View
    {
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => (string) $request->query('email', ''),
        ]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'token' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'max:255', 'confirmed'],
        ]);
        $email = mb_strtolower($data['email']);

        $row = DB::table('admin_password_reset_tokens')->where('email', $email)->first();
        $valid = $row
            && hash_equals($row->token, hash('sha256', $data['token']))
            && $row->created_at
            && now()->diffInMinutes($row->created_at, true) <= self::EXPIRY_MINUTES;

        $admin = $valid
            ? DB::table('admins')->where('email', $email)->where('is_active', true)->first()
            : null;

        if (!$admin) {
            throw ValidationException::withMessages([
                'email' => 'This password reset link is invalid or has expired. Please request a new one.',
            ]);
        }

        DB::table('admins')->where('id', $admin->id)->update([
            'password' => Hash::make($data['password']),
            'updated_at' => now(),
        ]);
        DB::table('admin_password_reset_tokens')->where('email', $email)->delete();
        $this->log($admin->id, 'admin.password_reset_completed', $request);

        return redirect()->route('admin.login')->with('status', 'Your password has been reset. Please sign in.');
    }

    private function log(int $adminId, string $action, Request $request): void
    {
        DB::table('admin_activity_logs')->insert([
            'admin_id' => $adminId,
            'action' => $action,
            'subject_type' => 'admin',
            'subject_id' => $adminId,
            'details' => null,
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

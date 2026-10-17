<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class StaffController extends Controller
{
    private const ROLES = [
        'super_admin' => 'Super Administrator',
        'administrator' => 'Administrator',
        'content_manager' => 'Content Manager',
        'finance_manager' => 'Finance Manager',
        'volunteer_coordinator' => 'Volunteer Coordinator',
    ];

    private function currentAdmin(): object
    {
        $admin = DB::table('admins')
            ->where('id', session('charity_admin_id'))
            ->where('is_active', true)
            ->first();

        abort_unless($admin, 403, 'An active administrator sign-in is required.');

        return $admin;
    }

    private function requireSuperAdmin(): object
    {
        $admin = $this->currentAdmin();
        abort_unless($admin->role === 'super_admin', 403, 'Only a Super Administrator can manage staff accounts.');

        return $admin;
    }

    private function log(object $admin, string $action, ?int $subjectId = null, array $details = []): void
    {
        DB::table('admin_activity_logs')->insert([
            'admin_id' => $admin->id,
            'action' => $action,
            'subject_type' => 'admin',
            'subject_id' => $subjectId,
            'details' => $details ? json_encode($details, JSON_THROW_ON_ERROR) : null,
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function index(): View
    {
        $admin = $this->requireSuperAdmin();

        $staff = DB::table('admins')
            ->orderByRaw("CASE WHEN role = 'super_admin' THEN 0 ELSE 1 END")
            ->orderBy('name')
            ->paginate(15);

        $activity = DB::table('admin_activity_logs')
            ->leftJoin('admins', 'admin_activity_logs.admin_id', '=', 'admins.id')
            ->select('admin_activity_logs.*', 'admins.name as actor_name')
            ->orderByDesc('admin_activity_logs.created_at')
            ->limit(12)
            ->get();

        return view('admin.staff.index', [
            'admin' => $admin,
            'staff' => $staff,
            'roles' => self::ROLES,
            'activity' => $activity,
            'activeCount' => DB::table('admins')->where('is_active', true)->count(),
            'roleCount' => DB::table('admins')->where('role', 'super_admin')->where('is_active', true)->count(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $actor = $this->requireSuperAdmin();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'role' => ['required', Rule::in(array_keys(self::ROLES))],
            'password' => ['required', 'string', 'min:12', 'confirmed', 'max:255'],
        ]);

        $id = DB::table('admins')->insertGetId([
            'name' => $data['name'],
            'email' => mb_strtolower($data['email']),
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'is_active' => true,
            'last_login_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->log($actor, 'staff.created', $id, [
            'email' => mb_strtolower($data['email']),
            'role' => $data['role'],
        ]);

        return redirect()->route('admin.staff.index')->with('status', 'Staff account created successfully.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $actor = $this->requireSuperAdmin();
        $target = DB::table('admins')->where('id', $id)->first();

        abort_unless($target, 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($id)],
            'role' => ['required', Rule::in(array_keys(self::ROLES))],
            'is_active' => ['required', 'boolean'],
            'password' => ['nullable', 'string', 'min:12', 'confirmed', 'max:255'],
        ]);

        $willBeActive = (bool) $data['is_active'];
        $willBeSuperAdmin = $data['role'] === 'super_admin';

        if ((int) $actor->id === $id && (!$willBeActive || !$willBeSuperAdmin)) {
            throw ValidationException::withMessages([
                'role' => 'You cannot deactivate or demote your own Super Administrator account.',
            ]);
        }

        if ($target->role === 'super_admin' && $target->is_active && (!$willBeActive || !$willBeSuperAdmin)) {
            $otherActiveOwners = DB::table('admins')
                ->where('role', 'super_admin')
                ->where('is_active', true)
                ->where('id', '<>', $id)
                ->count();

            if ($otherActiveOwners < 1) {
                throw ValidationException::withMessages([
                    'role' => 'At least one active Super Administrator must remain.',
                ]);
            }
        }

        $changes = [
            'name' => $data['name'],
            'email' => mb_strtolower($data['email']),
            'role' => $data['role'],
            'is_active' => $willBeActive,
            'updated_at' => now(),
        ];

        if (!empty($data['password'])) {
            $changes['password'] = Hash::make($data['password']);
        }

        DB::table('admins')->where('id', $id)->update($changes);

        $this->log($actor, 'staff.updated', $id, [
            'role' => $data['role'],
            'is_active' => $willBeActive,
            'password_reset' => !empty($data['password']),
        ]);

        return redirect()->route('admin.staff.index')->with('status', 'Staff account updated successfully.');
    }
}

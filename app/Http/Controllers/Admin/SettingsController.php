<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SettingsController extends Controller
{
    private function admin(): object
    {
        $admin = DB::table('admins')->where('id', session('charity_admin_id'))->where('is_active', true)->first();
        abort_unless($admin, 403, 'An active administrator sign-in is required.');
        abort_unless(in_array($admin->role, ['super_admin', 'administrator'], true), 403, 'Only administrators can manage organisation settings and audit history.');
        return $admin;
    }

    private function defaults(): array
    {
        return [
            'foundation_name' => ['label' => 'Foundation name', 'group_name' => 'organisation', 'value' => 'Muhamadi R Charity Foundation Uganda'],
            'public_email' => ['label' => 'Public contact email', 'group_name' => 'contact', 'value' => ''],
            'public_phone' => ['label' => 'Public contact phone', 'group_name' => 'contact', 'value' => ''],
            'office_address' => ['label' => 'Office address', 'group_name' => 'contact', 'value' => ''],
            'notification_email' => ['label' => 'Administrator notification email', 'group_name' => 'notifications', 'value' => env('FOUNDATION_NOTIFICATION_EMAIL', '')],
            'timezone' => ['label' => 'Application timezone', 'group_name' => 'system', 'value' => config('app.timezone', 'UTC')],
        ];
    }

    public function edit(): View
    {
        $admin = $this->admin();
        foreach ($this->defaults() as $key => $definition) {
            if (!DB::table('foundation_settings')->where('key', $key)->exists()) {
                DB::table('foundation_settings')->insert([
                    'key' => $key, 'label' => $definition['label'], 'group_name' => $definition['group_name'],
                    'value' => $definition['value'], 'updated_by' => $admin->id, 'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
        $settings = DB::table('foundation_settings')->orderBy('group_name')->orderBy('id')->get();
        return view('admin.settings.edit', compact('admin', 'settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $admin = $this->admin();
        $data = $request->validate([
            'settings' => ['required', 'array'],
            'settings.foundation_name' => ['required', 'string', 'max:180'],
            'settings.public_email' => ['nullable', 'email', 'max:190'],
            'settings.public_phone' => ['nullable', 'string', 'max:60'],
            'settings.office_address' => ['nullable', 'string', 'max:300'],
            'settings.notification_email' => ['nullable', 'email', 'max:190'],
            'settings.timezone' => ['required', 'timezone'],
        ]);

        DB::transaction(function () use ($data, $admin, $request) {
            foreach ($data['settings'] as $key => $value) {
                abort_unless(array_key_exists($key, $this->defaults()), 422);
                DB::table('foundation_settings')->where('key', $key)->update([
                    'value' => is_string($value) ? trim($value) : $value,
                    'updated_by' => $admin->id,
                    'updated_at' => now(),
                ]);
            }
            DB::table('admin_activity_logs')->insert([
                'admin_id' => $admin->id, 'action' => 'settings.updated', 'subject_type' => 'foundation_settings',
                'subject_id' => null, 'details' => json_encode(['keys' => array_keys($data['settings'])]),
                'ip_address' => $request->ip(), 'created_at' => now(), 'updated_at' => now(),
            ]);
        });

        return redirect()->route('admin.settings.edit')->with('status', 'Foundation settings saved.');
    }

    public function activityLog(Request $request): View
    {
        $this->admin();
        $logs = DB::table('admin_activity_logs')
            ->leftJoin('admins', 'admins.id', '=', 'admin_activity_logs.admin_id')
            ->select('admin_activity_logs.*', 'admins.name as admin_name', 'admins.email as admin_email')
            ->orderByDesc('admin_activity_logs.created_at')
            ->paginate(30)
            ->withQueryString();
        return view('admin.settings.activity-log', compact('logs'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends Controller
{
    private function admin(): object
    {
        $admin = DB::table('admins')->where('id', session('charity_admin_id'))->where('is_active', true)->first();
        abort_unless($admin, 403, 'An active administrator sign-in is required.');
        abort_unless(in_array($admin->role, ['super_admin', 'administrator', 'finance_manager', 'content_manager', 'volunteer_coordinator'], true), 403);
        return $admin;
    }

    private function range(Request $request): array
    {
        $data = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);
        return [$data['from'] ?? null, $data['to'] ?? null];
    }

    private function query(string $report, ?string $from, ?string $to): array
    {
        $map = [
            'donations' => ['table' => 'donations', 'date' => 'donation_date', 'columns' => ['id','receipt_number','donor_name','email','phone','amount','currency','payment_method','payment_status','reference','donation_date','created_at']],
            'projects' => ['table' => 'impact_records', 'date' => 'created_at', 'columns' => ['id','title','category','location','summary','beneficiaries_count','status','published_at','created_at']],
            'stories' => ['table' => 'stories', 'date' => 'created_at', 'columns' => ['id','title','category','author_name','status','published_at','created_at']],
            'volunteers' => ['table' => 'volunteer_applications', 'date' => 'created_at', 'columns' => ['id','name','email','phone','area_of_interest','availability','status','created_at']],
            'enquiries' => ['table' => 'contact_enquiries', 'date' => 'created_at', 'columns' => ['id','name','email','phone','subject','status','responded_at','created_at']],
        ];
        abort_unless(isset($map[$report]), 404);
        $definition = $map[$report];
        $query = DB::table($definition['table'])->select($definition['columns']);
        if ($from) $query->whereDate($definition['date'], '>=', $from);
        if ($to) $query->whereDate($definition['date'], '<=', $to);
        return [$query, $definition];
    }

    public function index(Request $request): View
    {
        $admin = $this->admin();
        [$from, $to] = $this->range($request);
        $donations = DB::table('donations');
        if ($from) $donations->whereDate('donation_date', '>=', $from);
        if ($to) $donations->whereDate('donation_date', '<=', $to);

        $canViewFinance = in_array($admin->role, ['super_admin', 'administrator', 'finance_manager'], true);
        $canViewContent = in_array($admin->role, ['super_admin', 'administrator', 'content_manager'], true);
        $summary = [
            'donation_count' => (clone $donations)->count(),
            'paid_total' => (clone $donations)->where('payment_status', 'paid')->sum('amount'),
            'pending_total' => (clone $donations)->where('payment_status', 'pending')->sum('amount'),
            'published_projects' => DB::table('impact_records')->where('status', 'published')->count(),
            'published_stories' => DB::table('stories')->where('status', 'published')->count(),
            'open_volunteers' => DB::table('volunteer_applications')->whereIn('status', ['new','reviewing'])->count(),
            'open_enquiries' => DB::table('contact_enquiries')->whereIn('status', ['new','in_progress'])->count(),
        ];

        $recentDonations = $canViewFinance ? (clone $donations)->orderByDesc('donation_date')->limit(10)->get() : collect();
        return view('admin.reports.index', compact('admin', 'summary', 'recentDonations', 'from', 'to', 'canViewFinance', 'canViewContent'));
    }

    public function export(Request $request, string $report): StreamedResponse
    {
        $admin = $this->admin();
        $allowedRoles = match ($report) {
            'donations' => ['super_admin', 'administrator', 'finance_manager'],
            'projects', 'stories' => ['super_admin', 'administrator', 'content_manager'],
            'volunteers' => ['super_admin', 'administrator', 'content_manager', 'finance_manager', 'volunteer_coordinator'],
            'enquiries' => ['super_admin', 'administrator', 'content_manager', 'finance_manager'],
            default => [],
        };
        abort_unless(in_array($admin->role, $allowedRoles, true), 403, 'Your role cannot export this report.');
        [$from, $to] = $this->range($request);
        [$query, $definition] = $this->query($report, $from, $to);
        $filename = 'muhamadi-foundation-'.$report.'-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function () use ($query, $definition) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, $definition['columns']);
            $query->orderByDesc('id')->chunk(500, function ($rows) use ($out, $definition) {
                foreach ($rows as $row) {
                    $line = [];
                    foreach ($definition['columns'] as $column) {
                        $value = $row->{$column} ?? '';
                        if (is_string($value) && preg_match('/^[=+@\-\\t\\r]/', $value)) $value = "'".$value;
                        $line[] = $value;
                    }
                    fputcsv($out, $line);
                }
            });
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}

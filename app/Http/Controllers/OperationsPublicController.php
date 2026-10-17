<?php

namespace App\\Http\\Controllers;

use Illuminate\\Http\\RedirectResponse;
use Illuminate\\Http\\Request;
use Illuminate\\Support\\Facades\\DB;
use Illuminate\\Support\\Str;
use Illuminate\\View\\View;

class OperationsPublicController extends Controller
{
    public function impact(): View
    {
        return view('public.operations-list', [
            'kind' => 'impact',
            'title' => 'Projects & impact',
            'intro' => 'Progress, outputs and outcomes recorded by the foundation. Beneficiary totals appear only when entered and verified by the team.',
            'records' => DB::table('impact_records')->where('status','published')->orderBy('sort_order')->orderByDesc('published_at')->get(),
        ]);
    }

    public function stories(): View
    {
        return view('public.operations-list', [
            'kind' => 'stories',
            'title' => 'Stories & news',
            'intro' => 'Approved articles, field stories and announcements from the foundation.',
            'records' => DB::table('stories')->where('status','published')->whereNotNull('published_at')->orderByDesc('published_at')->get(),
        ]);
    }

    public function story(string $slug): View
    {
        $story = DB::table('stories')->where('slug',$slug)->where('status','published')->whereNotNull('published_at')->first();
        abort_unless($story, 404);
        return view('public.story-detail', compact('story'));
    }

    public function gallery(): View
    {
        return view('public.operations-list', [
            'kind' => 'gallery',
            'title' => 'Community gallery',
            'intro' => 'Photographs approved for publication by the foundation.',
            'records' => DB::table('gallery_items')->where('status','published')->orderBy('sort_order')->orderByDesc('created_at')->get(),
        ]);
    }

    public function donate(Request $request): RedirectResponse
    {
        if ($request->filled('website')) return redirect()->route('get-involved')->with('status', 'Thank you. Your request has been received.');
        $data = $request->validate([
            'donor_name' => ['required','string','max:160'],
            'email' => ['nullable','email','max:190'],
            'phone' => ['nullable','string','max:40'],
            'amount' => ['required','numeric','gt:0','max:999999999999'],
            'payment_method' => ['required','string','in:Mobile Money,Bank transfer,Cash,Other'],
        ]);
        DB::table('donations')->insert([
            'donor_name' => $data['donor_name'], 'email' => $data['email'] ?? null, 'phone' => $data['phone'] ?? null,
            'amount' => $data['amount'], 'currency' => 'UGX', 'payment_method' => $data['payment_method'],
            'payment_status' => 'pending', 'reference' => null, 'donation_date' => now()->toDateString(),
            'admin_notes' => 'Public donation pledge; payment must be verified by an administrator.', 'created_at' => now(), 'updated_at' => now(),
        ]);
        return redirect()->route('get-involved')->with('status', 'Your donation pledge has been recorded as pending. The team must confirm payment before a receipt can be issued.');
    }

    public function volunteer(Request $request): RedirectResponse
    {
        if ($request->filled('website')) return redirect()->route('get-involved')->with('status', 'Thank you. Your application has been received.');
        $data = $request->validate([
            'name' => ['required','string','max:160'], 'email' => ['required','email','max:190'], 'phone' => ['nullable','string','max:40'],
            'area_of_interest' => ['required','string','max:180'], 'availability' => ['nullable','string','max:160'],
            'experience' => ['nullable','string','max:5000'], 'motivation' => ['required','string','max:5000'],
            'consent' => ['accepted'],
        ]);
        unset($data['consent']);
        DB::table('volunteer_applications')->insert($data + ['status'=>'new','admin_notes'=>null,'created_at'=>now(),'updated_at'=>now()]);
        return redirect()->route('get-involved')->with('status', 'Your volunteer application has been submitted for review.');
    }

    public function contact(Request $request): RedirectResponse
    {
        if ($request->filled('website')) return redirect()->route('contact')->with('status', 'Thank you. Your enquiry has been received.');
        $data = $request->validate([
            'name' => ['required','string','max:160'], 'email' => ['required','email','max:190'], 'phone' => ['nullable','string','max:40'],
            'subject' => ['required','string','max:180'], 'message' => ['required','string','max:10000'],
        ]);
        DB::table('contact_enquiries')->insert($data + ['status'=>'new','admin_notes'=>null,'response_notes'=>null,'responded_at'=>null,'created_at'=>now(),'updated_at'=>now()]);
        return redirect()->route('contact')->with('status', 'Thank you. Your enquiry has been saved and is awaiting review.');
    }
}

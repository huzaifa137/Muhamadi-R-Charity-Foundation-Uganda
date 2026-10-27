<?php

namespace App\Http\Controllers;

use App\Models\SitePageContent;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    public function home(): View
    {
        return view('public.home', ['page' => SitePageContent::where('page_key', 'home')->firstOrFail()]);
    }

    public function getInvolved(): View
    {
        return view('public.get-involved', ['page' => SitePageContent::where('page_key', 'get-involved')->firstOrFail()]);
    }

    public function contact(): View
    {
        return view('public.contact', ['page' => SitePageContent::where('page_key', 'contact')->firstOrFail()]);
    }
}

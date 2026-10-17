<?php

namespace App\Http\Controllers;

use App\Models\AboutPageContent;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    public function __invoke(): View
    {
        return view('public.about', [
            'about' => AboutPageContent::firstOrFail(),
        ]);
    }
}

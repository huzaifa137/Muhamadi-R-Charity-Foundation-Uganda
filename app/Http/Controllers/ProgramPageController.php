<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\View\View;

class ProgramPageController extends Controller
{
    public function __invoke(): View
    {
        return view('public.programs', [
            'programs' => Program::published()->orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }
}

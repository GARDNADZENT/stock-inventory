<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        return view('public.home');
    }

    public function privacyPolicy(): View
    {
        return view('public.privacy-policy');
    }
}

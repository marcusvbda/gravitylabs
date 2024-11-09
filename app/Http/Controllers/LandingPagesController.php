<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LandingPagesController extends Controller
{
    public function index(): View|RedirectResponse
    {
        return view('lps.home');
    }
}

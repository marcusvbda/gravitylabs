<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Auth;
use Illuminate\Http\RedirectResponse;

class LandingPagesController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect(route('app.dashboard'));
        }

        return redirect(route('app.dashboard'));
        // return view('lps.home');
    }
}

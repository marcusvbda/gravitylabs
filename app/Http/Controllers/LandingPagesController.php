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
            return redirect(route('app.applications.index'));
        }

        return view('lps.home');
    }
}

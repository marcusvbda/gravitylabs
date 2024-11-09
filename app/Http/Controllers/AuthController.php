<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Auth;

class AuthController extends Controller
{
    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect(route('app.dashboard'));
        }
        return view('auth.login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect(route('lps.home'));
    }
}

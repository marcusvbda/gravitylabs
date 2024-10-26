<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Auth;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect(route('lps.home'));
    }
}

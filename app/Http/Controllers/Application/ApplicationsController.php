<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ApplicationsController extends Controller
{
    public function index(): View
    {
        return view('application.applications.index');
    }
}

<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(): String
    {
        return "dashboard";
    }
}

<?php

use App\Http\Controllers\Application\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\authMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware([authMiddleware::class])->group(function () {
    Route::group(['prefix' => 'app', 'as' => 'app.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
});

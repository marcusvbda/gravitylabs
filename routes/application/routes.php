<?php

use App\Http\Middleware\authMiddleware;
use App\Livewire\Application\MyApps;
use App\Livewire\Auth\LoginPage;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('/login', LoginPage::class)->name('login')->lazy();
    Route::get('/logout', function () {
        Auth::logout();
        return redirect(route('lps.home'));
    })->name('logout');
});

Route::middleware([authMiddleware::class])->group(function () {
    Route::group(['prefix' => 'app', 'as' => 'app.'], function () {
        Route::get('/', fn() => redirect()->route('app.applications.index'));
        Route::group(['prefix' => 'applications', 'as' => 'applications.'], function () {
            Route::get('/', MyApps::class)->name('index')->lazy();
        });
    });
});

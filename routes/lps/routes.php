<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPagesController;

Route::group(['prefix' => '', 'as' => 'lps.'], function () {
    Route::get('/', [LandingPagesController::class, 'index'])->name('home');
});

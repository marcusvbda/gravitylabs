<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '', 'as' => 'lps.'], function () {
    Route::get('/', fn() => view('lps.home'))->name('home');
});

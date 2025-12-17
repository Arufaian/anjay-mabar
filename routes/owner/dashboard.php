<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('owner.dashboard');
})->name('dashboard');

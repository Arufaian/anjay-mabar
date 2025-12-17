<?php

use App\Http\Controllers\MooraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MooraController::class, 'index'])->name('moora.index');
Route::post('/calculate', [MooraController::class, 'calculate'])->name('moora.calculate');
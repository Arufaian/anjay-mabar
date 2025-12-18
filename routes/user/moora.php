<?php

use App\Http\Controllers\UserMooraController;
use Illuminate\Support\Facades\Route;

Route::get('/motor-analysis', [UserMooraController::class, 'create'])->name('moora.create');
Route::post('/motor-analysis', [UserMooraController::class, 'calculate'])->name('moora.calculate');
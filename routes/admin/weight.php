<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightsController;

Route::get('/weights', [WeightsController::class, 'index'])->name('weights.index');
Route::put('/weights', [WeightsController::class, 'update'])->name('weights.update');
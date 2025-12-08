<?php

use App\Http\Controllers\WeightsController;
use Illuminate\Support\Facades\Route;

Route::get('/weights', [WeightsController::class, 'index'])->name('weights.index');
Route::put('/weights', [WeightsController::class, 'update'])->name('weights.update');

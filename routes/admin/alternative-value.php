<?php

use App\Http\Controllers\AlternativeValueController;
use Illuminate\Support\Facades\Route;

Route::prefix('alternative-value')->name('alternative-value.')->group(function () {
    Route::get('/', [AlternativeValueController::class, 'index'])->name('index');
});

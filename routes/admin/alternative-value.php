<?php

use App\Http\Controllers\AlternativeValueController;
use Illuminate\Support\Facades\Route;

Route::prefix('alternative-value')->name('alternative-value.')->group(function () {
    Route::get('/', [AlternativeValueController::class, 'index'])->name('index');
    Route::get('/create', [AlternativeValueController::class, 'create'])->name('create');
    Route::post('/', [AlternativeValueController::class, 'store'])->name('store');
    Route::get('/{alternativeValue}/edit', [AlternativeValueController::class, 'edit'])->name('edit');
    Route::put('/{alternativeValue}', [AlternativeValueController::class, 'update'])->name('update');
    Route::delete('/{alternativeValue}', [AlternativeValueController::class, 'destroy'])->name('destroy');
});

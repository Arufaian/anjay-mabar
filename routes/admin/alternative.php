<?php

use App\Http\Controllers\AlternativeController;
use Illuminate\Support\Facades\Route;

Route::prefix('alternative')->name('alternative.')->group(function () {
    Route::get('/', [AlternativeController::class, 'index'])->name('index');
    Route::post('/', [AlternativeController::class, 'store'])->name('store');
    Route::get('/{alternative}/edit', [AlternativeController::class, 'edit'])->name('edit');
    Route::put('/{alternative}', [AlternativeController::class, 'update'])->name('update');
    Route::delete('/{alternative}', [AlternativeController::class, 'destroy'])->name('destroy');
    Route::get('/{alternative}', [AlternativeController::class, 'show'])->name('show');
});
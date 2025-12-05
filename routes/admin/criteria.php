<?php

use App\Http\Controllers\CriteriaController;
use Illuminate\Support\Facades\Route;

Route::prefix('criteria')->name('criteria.')->group(function () {
    Route::get('/', [CriteriaController::class, 'index'])->name('index');
    Route::get('/{criteria}/edit', [CriteriaController::class, 'edit'])->name('edit');
    Route::post('/', [CriteriaController::class, 'store'])->name('store');
    Route::put('/{criteria}', [CriteriaController::class, 'update'])->name('update');
    Route::delete('/{criteria}', [CriteriaController::class, 'destroy'])->name('destroy');
});

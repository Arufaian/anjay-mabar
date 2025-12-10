<?php

use App\Http\Controllers\AlternativeController;
use Illuminate\Support\Facades\Route;

Route::get('/alternative', [AlternativeController::class, 'index'])->name('alternative.index');
Route::post('/alternative', [AlternativeController::class, 'store'])->name('alternative.store');
Route::get('/alternative/{alternative}/edit', [AlternativeController::class, 'edit'])->name('alternative.edit');
Route::put('/alternative/{alternative}', [AlternativeController::class, 'update'])->name('alternative.update');
Route::delete('/alternative/{alternative}', [AlternativeController::class, 'destroy'])->name('alternative.destroy');
Route::get('/alternative/{alternative}', [AlternativeController::class, 'show'])->name('alternative.show');
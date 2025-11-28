<?php

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('criteria')->name('criteria.')->group(function () {
        Route::get('/', [CriteriaController::class, 'index'])->name('index');
        Route::post('/', [CriteriaController::class, 'store'])->name('store');
        Route::delete('/{criteria}', [CriteriaController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';

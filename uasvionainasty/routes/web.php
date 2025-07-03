<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardController;

// Grouped route for guards with prefix and middleware (contoh)
Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('guards/export', [GuardController::class, 'export'])->name('guards.export');
    Route::get('guards/search', [GuardController::class, 'search'])->name('guards.search');
    Route::resource('guards', GuardController::class);
});

// Route untuk API (contoh)
Route::prefix('api')->group(function () {
    Route::get('guards', [GuardController::class, 'apiIndex']);
    Route::get('guards/{id}', [GuardController::class, 'apiShow']);
});

// Route utama tetap redirect ke guards
Route::get('/', function () {
    return redirect()->route('guards.index');
});

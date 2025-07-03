<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuardController;

Route::get('/', function () {
    return redirect()->route('guards.index');
});

Route::resource('guards', GuardController::class);

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RealtimeController;

Route::get('/realtime', [RealtimeController::class, 'index']);
Route::get('/dashboard', [RealtimeController::class, 'dashboard']);
Route::post('/dashboard', [RealtimeController::class, 'getOIData'])->name('get_oi_data');

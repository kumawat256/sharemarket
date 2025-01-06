<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RealtimeController;
use App\Events\DataReceived;

Route::get('/realtime', [RealtimeController::class, 'index']);
Route::get('/dashboard', [RealtimeController::class, 'dashboard'])->name('dashboard_view');
Route::post('/dashboard', [RealtimeController::class, 'getOIData'])->name('get_oi_data');
// Route::get('/broadcast', function () {
//     event(new DataReceived('Test Message'));
// });
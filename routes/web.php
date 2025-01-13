<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RealtimeController;
use App\Events\DataReceived;
use App\Http\Controllers\MarketController;

Route::get('/realtime', [RealtimeController::class, 'index']);
Route::get('/dashboard', [RealtimeController::class, 'dashboard'])->name('dashboard_view');
Route::post('/dashboard', [RealtimeController::class, 'getOIData'])->name('get_oi_data');
Route::post('/get-expiry', [RealtimeController::class, 'getExpiry'])->name('getExpiry');
Route::any('/import-csv', [RealtimeController::class, 'storeCards'])->name('storeCards');
Route::any('/get_market_index_and_stocks', [MarketController::class, 'getMarketIndexAndStocks'])->name('get_market_index_and_stocks');
// Route::get('/broadcast', function () {
//     event(new DataReceived('Test Message'));
// });
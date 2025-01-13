<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    public function getMarketIndexAndStocks(Request $request)
    {
        $query = $request->get('query');

        $results = DB::table('market_instruments')
            ->where('SEM_TRADING_SYMBOL', 'LIKE', "%{$query}%")
            ->orWhere('SM_SYMBOL_NAME', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($results);
    }

}

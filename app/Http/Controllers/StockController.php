<?php

namespace App\Http\Controllers;

use App\Stock;
use App\UserStocks;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function getAllStocks()
    {
        $stocks = Stock::getAllStocksAndMarkets();
        dd($stocks->toArray());
    }

    public function getStockFromMarket($marketID)
    {
        $stocks = Stock::getAllStocksFromMarket($marketID);

        $userStocks = [];

        if(Auth::check()) {
            $userStocks = array_keys(UserStocks::getUserStocks(Auth::id()));
        }
        $data = [
            'stocks'      => $stocks,
            'user_stocks' => $userStocks,
        ];
        return view('stocks.index', $data)->withTitle('Stocks');
    }
}

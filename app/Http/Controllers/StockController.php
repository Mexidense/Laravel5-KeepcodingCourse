<?php

namespace App\Http\Controllers;

use App\Stock;

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
        dd($stocks->toArray());
    }
}

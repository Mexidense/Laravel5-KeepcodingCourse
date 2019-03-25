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
}

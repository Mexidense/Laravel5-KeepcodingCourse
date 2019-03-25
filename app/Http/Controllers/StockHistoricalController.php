<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
use Illuminate\Http\Request;

class StockHistoricalController extends Controller
{
    public function index(string $stock, string $method) {
        $params = [
            'function'   => $method,
            'symbol'     => $stock,
            'outputsize' => 'compact',
        ];

        $stockValues = HelperAlphavantage::getArrayReply($params);

        dd(HelperAlphavantage::processArray($stockValues));
    }

    public function create(Request $request)
    {

    }
}

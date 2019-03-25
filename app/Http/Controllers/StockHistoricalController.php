<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
use Illuminate\Support\Facades\Config;

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

    public function saveStockHistorical($stock) {
        $stockValuesProcessed = $this->getStockClosingValues($stock);
        $smaProcessed6        = $this->getStockSMA($stock, 6);
        $smaProcessed70       = $this->getStockSMA($stock, 70);
        $smaProcessed200      = $this->getStockSMA($stock, 200);
    }

    private function getStockClosingValues($stock)
    {
        $params = [
            'function'   => Config::get('larastock.closing_values_method'),
            'symbol'     => $stock,
            'outputsize' => 'compact',
        ];

        $stockValues = HelperAlphavantage::getArrayReply($params);
        return HelperAlphavantage::processArray($stockValues);
    }

    private function getStockSMA($stock, $smaPeriod)
    {
        $params = [
            'function'   => Config::get('larastock.moving_average_values_method'),
            'symbol'     => $stock,
            'interval'   => 'daily',
            'time_period'=> $smaPeriod,
            'series_type'=> 'close',
            'outputsize' => 'compact',
        ];

        $sma = HelperAlphavantage::getArrayReply($params);
        return HelperAlphavantage::processArray($sma);
    }
}

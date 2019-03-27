<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
use App\Helpers\HelperChart;
use App\Stock;
use App\StockHistorical;
use Barryvdh\Debugbar\Facade as Debugbar;
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
        $stockID = Stock::getStockID($stock);

        $stockValuesProcessed = $this->getStockClosingValues($stock);
        $smaProcessed6        = $this->getStockSMA($stock, 6);
        $smaProcessed70       = $this->getStockSMA($stock, 70);
        $smaProcessed200      = $this->getStockSMA($stock, 200);


        if (is_array($stockValuesProcessed)) {
            $stockHistorical = new StockHistorical();

            foreach ($stockValuesProcessed as $date => $stockValue) {
                $input = [
                    'stock_id' => $stockID,
                    'date'     => $date,
                    'value'    => $stockValue,
                    'avg_6'    => isset($smaProcessed6[$date])?:0.0,
                    'avg_70'   => isset($smaProcessed70[$date])?:0.0,
                    'avg_200'  => isset($smaProcessed200[$date])?:0.0,
                ];
                if ($stockHistorical->validate($input)) {
                    $stockHistoricalSaved = StockHistorical::create($input);
                    echo "\nSaved values of $stock from date: $date\n";
                    //Debugbar::info('Saved values of ' . $stock . 'from date: ' . $date);
                }
                else {
                    echo "<br/>";
                    Debugbar::warning($stockHistorical->errors);
                }
            }
        }
    }

    public function stockHistoricalGraph($stockID)
    {
        echo HelperChart::generateStockChart($stockID);
    }

    public function stockHistoricalInfo($stockID)
    {
        $stockData = Stock::find($stockID);
        $stockName = $stockData->name;
        $stockHistorical = StockHistorical::getStockHistorical($stockID);
        $stockChart = HelperChart::generateStockChart($stockID);

        $data = [
            'stockData' => $stockData,
            'stockHistorical' => $stockHistorical,
            'stockChart' => $stockChart,
        ];

        return view('stock_historicals.index', $data)
            ->withTitle('Historical ' . $stockName);
    }

    private function getStockClosingValues($stock)
    {
        $params = [
            'function'   => Config::get('larastock.closing_values_method'),
            'symbol'     => $stock,
            'outputsize' => 'compact',
        ];

        $stockValues = HelperAlphavantage::getArrayReply($params);
        return HelperAlphavantage::processArray($stockValues, true);
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

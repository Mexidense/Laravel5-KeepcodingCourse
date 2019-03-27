<?php

namespace App\Http\Controllers;

use App\Helpers\HelperAlphavantage;
use App\Stock;
use App\StockHistorical;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Config;
use Khill\Lavacharts\Exceptions\InvalidColumnType;
use Khill\Lavacharts\Exceptions\InvalidLabel;
use Khill\Lavacharts\Exceptions\LavaException;
use Khill\Lavacharts\Lavacharts;

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
                    'avg_6'    => $smaProcessed6[$date],
                    'avg_70'   => $smaProcessed70[$date],
                    'avg_200'  => $smaProcessed200[$date],
                ];
                if ($stockHistorical->validate($input)) {
                    $stockHistoricalSaved = StockHistorical::create($input);
                    echo "<br/>";
                    Debugbar::info('Saved values of ' . $stock . 'from date: ' . $date);
                }
                else {
                    echo "<br/>";
                    Debugbar::warning($stockHistorical->errors);
                }
            }
        }
    }

    public function stockHistoricalGraph($stockID) {
        $lava = new Lavacharts();

        $data = $lava->DataTable();

        try {
            $data->addDateColumn('Day of Month')
                ->addNumberColumn('Value')
                ->addNumberColumn('SMA 6')
                ->addNumberColumn('SMA 70')
                ->addNumberColumn('SMA 200');
        } catch (LavaException $exception) {
            Debugbar::error($exception->getMessage());
        }

        $stockValues = StockHistorical::where('stock_id', $stockID)->get();
        foreach ($stockValues as $stockValue) {
            $data->addRow([
                $stockValue->date,
                $stockValue->value,
                $stockValue->avg_6,
                $stockValue->avg_70,
                $stockValue->avg_200,
            ]);
        }

        $lava->LineChart('StockPrices', $data, [
            'titleTextStyle' => [
                'fontName'  => 'Verdana',
                'fontColor' => 'blue',
            ],
            'title'          => 'Graph cuts ' . Stock::getStockName($stockID),
            'legend'         => [
                'position' => 'bottom',
            ],
        ]);

        echo "<div id='stocks-chart'></div>";
        echo $lava->render('LineChart', 'StockPrices', 'stocks-chart');
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

<?php

/**
 * @author Salvador Briones <salvador.briones@selectra.info>
 * @copyright Selectra
 * @since 27/03/19
 */

namespace App\Helpers;

use App\Stock;
use App\StockHistorical;
use Khill\Lavacharts\Exceptions\LavaException;
use Khill\Lavacharts\Lavacharts;
use Barryvdh\Debugbar\Facade as Debugbar;

class HelperChart {

    public static function generateStockChart($stockID)
    {
        $result = '';
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

        $result .= "<div id='stocks-chart'></div>";
        $result .= $lava->render('LineChart', 'StockPrices', 'stocks-chart');

        return $result;
    }
}
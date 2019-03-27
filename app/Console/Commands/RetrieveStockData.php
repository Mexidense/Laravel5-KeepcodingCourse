<?php

namespace App\Console\Commands;

use App\Http\Controllers\StockHistoricalController;
use App\Stock;
use App\StockHistorical;
use Illuminate\Console\Command;

class RetrieveStockData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'historicals:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Stocks Daily Data';

    /**
     * @var StockHistoricalController
     */
    protected $stockHistoricals;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StockHistoricalController $stockHistoricals)
    {
        parent::__construct();
        $this->stockHistoricals = $stockHistoricals;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stocks = Stock::all();

        foreach ($stocks as $stock) {
            if (!StockHistorical::isSavedStockHistorical($stock->id)) {
                echo "\ncronLog: " . date('d/m/Y H:i;s', time());
                echo "\nRetreiving " . $stock->acronym . "...\n";

                $this->stockHistoricals->saveStockHistorical($stock->acronym);
            }
        }
    }
}

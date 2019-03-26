<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $market_id
 * @property string $name
 * @property string $acronym
 * @property string $created_at
 * @property string $updated_at
 * @property Market $market
 */
class Stock extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['market_id', 'name', 'acronym'];

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Return all stock with associated marketç
     * @return Stock[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllStocksAndMarkets()
    {
        return self::with('market')->get();
    }

    /**
     * Returns all stocks by market ID
     * @param $marketID
     * @return Stock[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllStocksFromMarket($marketID)
    {
        return self::with(['market' => function ($query) {
            $query->select('id', 'name');
        }])->whereHas('market', function ($query) use ($marketID) {
            $query->where('id', $marketID);
        })->get();
    }

    /**
     * Return stock ID from acronym stock
     * @param $stock
     * @return mixed|string
     */
    public static function getStockID($stock)
    {
        $output = '';

        $stock = str_replace('.MC', '', $stock);

        $stockData = self::where('acronym', $stock)->first();
        if ($stockData) {
            $output = $stockData->getKey();
        }
        return $output;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}

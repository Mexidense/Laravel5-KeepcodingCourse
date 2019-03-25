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

    public static function getAllStocksAndMarkets()
    {
        return self::with('market')->get();
    }

    public static function getAllStocksFromMarket($marketID)
    {
        return self::with(['market' => function ($query) {
            $query->select('id', 'name');
        }])->whereHas('market', function ($query) use ($marketID) {
            $query->where('id', $marketID);
        })->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}

<?php

namespace App;

use App\Traits\ValidatorTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\StockHistorical
 *
 * @property int $id
 * @property int $stock_id
 * @property string $date
 * @property float $value
 * @property float $avg_6
 * @property float $avg_70
 * @property float $avg_200
 * @property string $created_at
 * @property string $updated_at
 * @property Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereAvg200($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereAvg6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereAvg70($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StockHistorical whereValue($value)
 * @mixin \Eloquent
 */
class StockHistorical extends Model
{
    use ValidatorTrait;
    /**
     * @var array
     */
    protected $fillable = ['stock_id', 'date', 'value', 'avg_6', 'avg_70', 'avg_200'];

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $rules = [
        'stock_id' => 'required|integer|unique_with:stock_historicals,date',
        'date'     => 'required|date_format:Y-m-d',
        'value'    => 'required|numeric',
        'avg_6'    => 'required|numeric',
        'avg_70'   => 'required|numeric',
        'avg_200'  => 'required|numeric',
    ];

    protected $dates = ['date'];

    public static function getStockHistorical($stockID, $startDate = null, $endDate = null)
    {
        $query = self::where('stock_id', $stockID);

        if (!is_null($startDate)) {
            $query->where('date', '>=', $startDate);
        }

        if (!is_null($endDate)) {
            $query->where('date', '<=', $endDate);
        }

        return $query->orderBy('date', 'DESC')->get();
    }

    public static function isSavedStockHistorical($stockID): bool
    {
        return (bool) self::where('stock_id', $stockID)
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}

<?php

namespace App;

use App\Traits\ValidatorTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $stock_id
 * @property Stock $stock
 * @property User $user
 */
class UserStocks extends Model
{
    use ValidatorTrait;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'stock_id'];

    public $timestamps = false;

    protected $rules = [
        'user_id'  => 'required|integer',
        'stock_id' => 'required|integer|exists:stocks,id|unique_with:user_stocks,user_id,stock_id',
    ];

    public static function getUserStocks(int $userID): array
    {
        return self::where('user_id', $userID)->get()->keyBy('stock_id')->toArray();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

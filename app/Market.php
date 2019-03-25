<?php

namespace App;

use App\Traits\ValidatorTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Market
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Market whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Market extends Model
{
    use ValidatorTrait;

    protected $fillable = [
        'name',
        'acronym',
        'description',
        'active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $rules = [
        'name' => 'required|max:255|min:5',
        'acronym' => 'required|max:10',
        'description' => 'required|max:255',
        'active' => 'boolean',
    ];


    public static function getAllMarkets()
    {
        return self::all();
    }

    public static function getActiveMarkets()
    {
        return self::where('active', 1)->get();
    }
}

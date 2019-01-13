<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    // protected $timestamps = false;
    // protected $primaryKey = 'market_id';
    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'created_at',
    ];

    public static function getAllMarkets()
    {
        return self::all();
    }
}

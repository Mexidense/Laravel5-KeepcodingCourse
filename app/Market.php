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
        'active',
    ];

    protected $hidden = [
        'created_at',
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

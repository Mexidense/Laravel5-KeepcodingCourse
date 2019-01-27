<?php

namespace App;

use App\Traits\ValidatorTrait;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use ValidatorTrait;

    protected $fillable = [
        'name',
        'description',
        'active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $rules = [
        'name' => 'required|max:255|min:5',
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

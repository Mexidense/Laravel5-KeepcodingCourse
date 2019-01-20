<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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
        'updated_at',
    ];

    public $errors; 

    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'required|max:255',
        'active' => 'boolean',
    ];

    public function validate($data) : bool
    {
        $validator = Validator::make($data, $this->rules);

        if($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }

    public static function getAllMarkets()
    {
        return self::all();
    }

    public static function getActiveMarkets()
    {
        return self::where('active', 1)->get();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;

class MarketController extends Controller
{
    public function index()
    {
        $markets = Market::all();
        dd($markets->toArray());
    }
}

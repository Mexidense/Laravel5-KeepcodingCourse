<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;
use Carbon\Carbon;

class MarketController extends Controller
{
    public function index()
    {
        $markets = Market::getAllMarkets();

        dd($markets->last());       
    }
}

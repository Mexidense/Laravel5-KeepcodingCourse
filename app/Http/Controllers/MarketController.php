<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MarketController extends Controller
{
    public function index($status = 'all')
    {
        if($status == 'active') {
            $markets = Market::getActiveMarkets();
        } else {
            $markets = Market::getAllMarkets();
        }
        
        $data = [
            'markets' => $markets,
        ];
        return view('markets.index', $data)->withTitle('Markets');  
    }

    public function create()
    {
        return view('markets.create')->withTitle('Create new market');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $market = new Market();

        if( $market->validate($input) ) {
            //Check if market is active
            $input['active'] = isset($input['active']) ? : 0;

            Market::create($input);
            //Send a message success
            $request->session()->flash('status_message', 'Market added');
            return redirect('markets');
        } else {
            return redirect('market/create')
                ->withInput()
                ->withErrors($market->errors);
        }
    }
}

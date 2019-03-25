<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Market;

/**
 * Class MarketController
 * @package App\Http\Controllers
 */
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

    public function show($id)
    {
        $market = Market::find($id);
        $data = [
            'market' => $market
        ];
        return view('markets.show', $data)
                ->withTitle('Market detail');
    }

    public function edit($id)
    {
        $market = Market::findOrFail($id);
        $data = [
            'market' => $market
        ];
        return view('markets.edit', $data)
                ->withTitle('Market edit');
    }

    public function update(Request $request, $id)
    {
        $market = Market::find($id);

        $input = $request->all();
        if ($market->validate($input)) {
            $market->name = $request->name;
            $market->description = $request->description;
            $market->active = (bool) $request->active;
            $market->save();

            // Create message and redirect to markets landing page.
            $request->session()->flash('status_message', 'Market edited');
            return redirect('markets');
        }
        return back()->withInput($input)->withErrors($market->errors);
    }

    public function destroy($id)
    {
        try{
            $market = Market::findOrFail($id);
            $market->delete();

            $status_message = 'Market removed';
        }
        catch (ModelNotFoundException $exception) {
            $status_message = 'Not market with that id';
        }

        \Session::flash('status_message', $status_message);

        return redirect('markets');
    }
}

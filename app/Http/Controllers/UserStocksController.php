<?php

namespace App\Http\Controllers;

use App\UserStocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStocksController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check()) {
            $loggerUser = Auth::user();

            $input = [
                'user_id'  => $loggerUser->id,
                'stock_id' => $request->stock_id,
            ];

            $userStocks = new UserStocks();

            if($userStocks->validate($input)) {
                UserStocks::create($input);
                return redirect()->back()->with('status_message', 'Subscription done');
            } else {
                return redirect()->back()->with('error_message', $userStocks->errors);
            }
        }
    }

    public function destroy(Request $request)
    {
        if(Auth::check()) {
            UserStocks::where('user_id', Auth::id())
                ->where('stock_id', $request->stock_id)
                ->delete();
            return redirect()->back()->with('status_message', 'Unsubscribe done');
        }
    }
}

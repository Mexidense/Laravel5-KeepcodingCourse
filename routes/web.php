<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('markets');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('market/{id}', 'MarketController@show');
Route::get('/markets/{status?}', 'MarketController@index');

Route::get('market/create', 'MarketController@create');
Route::post('market/create', 'MarketController@store')->name('market.create');

Route::get('market/{id}/edit', 'MarketController@edit');
Route::put('market/{id}/edit', 'MarketController@update')->name('market.edit');

Route::delete('market/{id}', 'MarketController@destroy')->name('market.destroy');


Route::get('stocks-from-market/{marketID}', 'StockController@getStockFromMarket');

Route::get('stock_historicals/{stock}/{method}', 'StockHistoricalController@index');
Route::get('stock_historicals/{stock}', 'StockHistoricalController@saveStockHistorical');

Route::get('stock_historicals_chart/{stockID}', 'StockHistoricalController@stockHistoricalGraph');

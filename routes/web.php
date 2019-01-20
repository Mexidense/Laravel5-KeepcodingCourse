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

Route::get('market/create', 'MarketController@create');
Route::post('market/create', 'MarketController@store')->name('market.create');

Route::get('/markets/{status?}', 'MarketController@index');
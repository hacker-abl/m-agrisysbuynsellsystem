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
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware'], function()
{
 Route::get('/home', 'HomeController@index')->name('home');
 Route::get('/Expense', 'expenseController@index')->name('expense');
  Route::get('/Trips', 'tripController@index')->name('trips');
  Route::get('/DTR', 'dtrController@index')->name('dtr');
  Route::get('/Outbound', 'odController@index')->name('od');
  Route::get('/CashAdvance', 'caController@index')->name('ca');
  Route::get('/Purchases', 'purchasesController@index')->name('purchases');
  Route::get('/Sales', 'salesController@index')->name('sales');
});

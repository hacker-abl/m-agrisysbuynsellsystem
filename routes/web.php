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
 Route::post('/add_expense', 'expenseController@store')->name('add_expense');
 Route::get('/refresh_expense', 'expenseController@refresh')->name('refresh_expense');
 Route::get('/Trips', 'tripController@index')->name('trips');
 Route::get('/DTR', 'dtrController@index')->name('dtr');
 Route::get('/Outbound', 'odController@index')->name('od');
 Route::get('/CashAdvance', 'caController@index')->name('ca');
 Route::get('/Purchases', 'purchasesController@index')->name('purchases');
 Route::get('/Sales', 'salesController@index')->name('sales');

// =======
//   Route::get('/Home', 'HomeController@index')->name('home');
//   Route::get('/Expense', 'expenseController@index')->name('expense');
//   Route::get('/Trips', 'tripController@index')->name('trips');
//   Route::get('/DTR', 'dtrController@index')->name('dtr');
//   Route::get('/Outbound', 'odController@index')->name('od');
//   Route::get('/CashAdvance', 'caController@index')->name('ca');
//   Route::get('/Purchases', 'purchasesController@index')->name('purchases');
//   Route::get('/Sales', 'salesController@index')->name('sales');

  //settings
  Route::get('/company', 'companyController@index')->name('company');
  Route::get('/employee', 'employeeController@index')->name('employee');
  Route::get('/customer', 'customerController@index')->name('customer');
  Route::get('/trucks', 'trucksController@index')->name('trucks');
  Route::get('/commodity', 'commodityController@index')->name('commodity');
  Route::get('/users', 'usersController@index')->name('users');
 
});

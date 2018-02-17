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
  Route::get('/expense', 'expenseController@index')->name('expense');
  Route::get('/trips', 'tripController@index')->name('trips');
  Route::get('/dTR', 'dtrController@index')->name('dtr');
  Route::get('/outbound', 'odController@index')->name('od');
  Route::get('/cashAdvance', 'caController@index')->name('ca');
  Route::get('/purchases', 'purchasesController@index')->name('purchases');
  Route::get('/sales', 'salesController@index')->name('sales');

  //settings
  Route::get('/company', 'companyController@index')->name('company');
  Route::get('/employee', 'employeeController@index')->name('employee');
  Route::get('/customer', 'customerController@index')->name('customer');
  Route::get('/trucks', 'trucksController@index')->name('trucks');
  Route::get('/commodity', 'commodityController@index')->name('commodity');
  Route::get('/users', 'usersController@index')->name('users');
});

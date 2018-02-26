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
 Route::post('/add_expense', 'expenseController@store')->name('add_expense');
 Route::get('/refresh_expense', 'expenseController@refresh')->name('refresh_expense');
 Route::get('/trips', 'tripController@index')->name('trips');
 Route::get('/dtr', 'dtrController@index')->name('dtr');
 Route::get('/outbound', 'odController@index')->name('od');
 Route::get('/cashadvance', 'caController@index')->name('ca');
 Route::get('/purchases', 'purchasesController@index')->name('purchases');
 Route::get('/sales', 'salesController@index')->name('sales');

 

  //settings
  Route::get('/company', 'companyController@index')->name('company');
  Route::post('/add_company', 'companyController@store')->name('add_company');
  Route::get('/refresh_company', 'companyController@refresh')->name('refresh_company');
  Route::get('/update_company', 'companyController@updatedata')->name('update_company');
  Route::get('/delete_company', 'companyController@deletedata')->name('delete_company');
  
  Route::get('/employee', 'employeeController@index')->name('employee');
  Route::post('/add_employee', 'employeeController@store')->name('add_employee');
  Route::get('/refresh_employee', 'employeeController@refresh')->name('refresh_employee');
  Route::get('/update_employee', 'employeeController@updatedata')->name('update_employee');
  Route::get('/delete_employee', 'employeeController@deletedata')->name('delete_employee');

  Route::get('/customer', 'customerController@index')->name('customer');
  Route::post('/add_customer', 'customerController@store')->name('add_customer');
  Route::get('/refresh_customer', 'customerController@refresh')->name('refresh_customer');
  Route::get('/update_customer', 'customerController@updatedata')->name('update_customer');
  Route::get('/delete_customer', 'customerController@deletedata')->name('delete_customer');

  Route::get('/trucks', 'trucksController@index')->name('trucks');
  Route::post('/add_trucks', 'trucksController@store')->name('add_trucks');
  Route::get('/refresh_trucks', 'trucksController@refresh')->name('refresh_trucks');
  Route::get('/update_trucks', 'trucksController@updatedata')->name('update_trucks');
  Route::get('/delete_trucks', 'trucksController@deletedata')->name('delete_trucks');

  Route::get('/commodity', 'commodityController@index')->name('commodity');
  Route::post('/add_commodity', 'commodityController@store')->name('add_commodity');
  Route::get('/refresh_commodity', 'commodityController@refresh')->name('refresh_commodity');
  Route::get('/update_commodity', 'commodityController@updatedata')->name('update_commodity');
  Route::get('/delete_commodity', 'commodityController@deletedata')->name('delete_commodity');
  
  Route::get('/users', 'usersController@index')->name('users');
  Route::post('/add_user', 'usersController@store')->name('add_user');
  Route::get('/refresh_user', 'usersController@refresh')->name('refresh_user');
  Route::get('/update_user', 'usersController@updatedata')->name('update_user');
  Route::get('/delete_user', 'usersController@deletedata')->name('delete_user');
});

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

    //OUTBOUND DELIVERIES
    Route::get('/outbound', 'odController@index')->name('od');
    Route::get('/refresh_deliveries', 'odController@refresh')->name('refresh_deliveries');
    Route::get('/refresh_id', 'odController@updateId')->name('refresh_id');
    Route::post('/add_delivery', 'odController@store')->name('add_delivery');
    Route::get('/update_delivery', 'odController@updatedata')->name('update_delivery');
    Route::get('/delete_delivery', 'odController@deletedata')->name('delete_delivery');

    //Sales
    Route::get('/sales', 'salesController@index')->name('sales');
    Route::get('/refresh_sales', 'salesController@refresh')->name('refresh_sales');
    Route::post('/add_sales', 'salesController@store')->name('add_sales');
    Route::get('/update_sales', 'salesController@updatedata')->name('update_sales');
    Route::get('/delete_sales', 'salesController@deletedata')->name('delete_sales');

    //CASH ADVANCE
    Route::get('/cashadvance', 'caController@index')->name('ca');
    Route::post('/add_cashadvance', 'caController@store')->name('add_cashadvance');
    Route::get('/refresh_cashadvance', 'caController@refresh')->name('refresh_cashadvance');
    Route::get('/refresh_view_cashadvance', 'caController@refresh_view')->name('refresh_view_cashadvance');
    Route::get('/check_balance', 'caController@check_balance')->name('check_balance');

    Route::get('/purchases', 'purchasesController@index')->name('purchases');

    //DTR
    Route::get('/check_employee', 'dtrController@check_employee')->name('check_employee');
    Route::get('/dtr_details', 'dtrController@dtr_details')->name('dtr_details');
    Route::get('/refresh_dtr', 'dtrController@refresh')->name('refresh_dtr');
    Route::get('/refresh_view_dtr', 'dtrController@refresh_view')->name('refresh_view_dtr');
    Route::post('/add_dtr', 'dtrController@store')->name('add_dtr');
    Route::post('/add_dtr_expense', 'dtrController@add_dtr_expense')->name('add_dtr_expense');

    //PICK UP
    Route::get('/get_pickup', 'tripController@updateId')->name('get_pickup');
    Route::get('/refresh_pickup', 'tripController@refresh')->name('refresh_pickup');
    Route::get('/update_pickup', 'tripController@updatedata')->name('update_pickup');
    Route::get('/delete_trip', 'tripController@deletedata')->name('delete_trip');
    Route::post('/add_pickup', 'tripController@store')->name('add_pickup');
    Route::post('/update_trip', 'tripController@update_trip')->name('update_trip');
    Route::post('/add_trip_expense', 'tripController@add_trip_expense')->name('add_trip_expense');

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

    Route::get('/roles', 'RolesController@index')->name('roles');
    Route::post('/add_role', 'RolesController@store')->name('add_role');
    Route::get('/refresh_roles', 'RolesController@refresh')->name('refresh_roles');
    Route::get('/update_role', 'RolesController@updatedata')->name('update_role');
    Route::get('/delete_role', 'RolesController@deletedata')->name('delete_role');

    //SEARCH AUTOCOMPLETE NAME FOR EXPENSES
    Route::get('autocomplete_name',array('as'=>'autocomplete_name','uses'=>'expenseController@autoComplete'));
});

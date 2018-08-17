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

Auth::routes();

Route::group(['middleware'=>['auth', 'cashier']], function() {
    //Notifications
    Route::get('/notification/get', 'NotificationController@get');
});

Route::group(['middleware'=>['auth', 'admin']], function() {
    Route::get('/expense', 'expenseController@index')->name('expense');
    Route::post('/add_expense', 'expenseController@store')->name('add_expense');
    Route::post('/refresh_expense', 'expenseController@refresh')->name('refresh_expense');
    Route::post('/trip_expense_view', 'tripController@trip_expense_view')->name('trip_expense_view');
    Route::get('/trips', 'tripController@index')->name('trips');
    Route::post('/release_update', 'tripController@release_update')->name('release_update');
    Route::post('/release_update_dtr', 'dtrController@release_update_dtr')->name('release_update_dtr');
    Route::post('/print_trip', 'pdfController@trips')->name('print_trip');
});

Route::group(['middleware'=>['auth', 'user:od']], function() {
    //OUTBOUND DELIVERIES
    Route::get('/outbound', 'odController@index')->name('od');
    Route::post('/refresh_deliveries', 'odController@refresh')->name('refresh_deliveries');
    Route::get('/refresh_id', 'odController@updateId')->name('refresh_id');
    Route::post('/add_delivery', 'odController@store')->name('add_delivery');
    Route::get('/update_delivery', 'odController@updatedata')->name('update_delivery');
    Route::get('/delete_delivery', 'odController@deletedata')->name('delete_delivery');
    Route::post('/print_od', 'pdfController@od')->name('print_od');
});

Route::group(['middleware'=>['auth', 'user:sales']], function() {
    //Sales
    Route::get('/sales', 'salesController@index')->name('sales');
    Route::post('/refresh_sales', 'salesController@refresh')->name('refresh_sales');
    Route::post('/add_sales', 'salesController@store')->name('add_sales');
    Route::get('/update_sales', 'salesController@updatedata')->name('update_sales');
    Route::get('/delete_sales', 'salesController@deletedata')->name('delete_sales');
    Route::post('/print_sales', 'pdfController@sales')->name('print_sales');
});

Route::group(['middleware'=>['auth', 'user:ca']], function() {
    //CASH ADVANCE
    Route::get('/cashadvance', 'caController@index')->name('ca');
    Route::post('/add_cashadvance', 'caController@store')->name('add_cashadvance');
    Route::get('/refresh_cashadvance', 'caController@refresh')->name('refresh_cashadvance');
    Route::get('/refresh_view_cashadvance', 'caController@refresh_view')->name('refresh_view_cashadvance');
    Route::get('/check_balance', 'caController@check_balance')->name('check_balance');
    Route::get('/refresh_balancedt', 'balanceController@refresh')->name('refresh_balancedt');
    Route::get('/balancelogs', 'balanceController@balance')->name('balancelogs');
    Route::post('/add_payment', 'balanceController@store')->name('add_payment');
    Route::post('/print_ca', 'pdfController@ca')->name('print_ca');
    Route::post('/print_balance_payment', 'pdfController@balance_payment')->name('print_balance_payment');
});

Route::group(['middleware'=>['auth', 'user:purchases']], function() {
    //PURCHASES
    Route::get('/purchases', 'purchasesController@index')->name('purchases');
    Route::get('/find_amt', 'purchasesController@findAmount')->name('find_amt');
    Route::get('/refresh_trans', 'purchasesController@updateId')->name('refresh_trans');
    Route::get('/findCustomer', 'purchasesController@updatecustomerId')->name('findCustomer');
    Route::get('/find_comm', 'purchasesController@findcomm')->name('find_comm');
    Route::post('/add_purchases', 'purchasesController@store')->name('add_purchases');
    Route::post('/refresh_purchases', 'purchasesController@refresh')->name('refresh_purchases');
    Route::post('/print_purchase', 'pdfController@purchases')->name('print_purchase');
});

Route::group(['middleware'=>['auth', 'user:dtr']], function() {
    //DTR
    Route::get('/check_employee', 'dtrController@check_employee')->name('check_employee');
    Route::get('/dtr_details', 'dtrController@dtr_details')->name('dtr_details');
    Route::get('/refresh_dtr', 'dtrController@refresh')->name('refresh_dtr');
    Route::get('/refresh_view_dtr', 'dtrController@refresh_view')->name('refresh_view_dtr');
    Route::post('/add_dtr', 'dtrController@store')->name('add_dtr');
    Route::post('/add_dtr_expense', 'dtrController@add_dtr_expense')->name('add_dtr_expense');
    Route::get('/dtr', 'dtrController@index')->name('dtr');
    Route::post('/print_dtr', 'pdfController@dtr')->name('print_dtr');
});

Route::group(['middleware'=>['auth', 'user:trips']], function() {
    //PICK UP
    Route::get('/get_pickup', 'tripController@updateId')->name('get_pickup');
    Route::post('/refresh_pickup', 'tripController@refresh')->name('refresh_pickup');
    Route::get('/update_pickup', 'tripController@updatedata')->name('update_pickup');
    Route::get('/delete_trip', 'tripController@deletedata')->name('delete_trip');
    Route::post('/add_pickup', 'tripController@store')->name('add_pickup');
    Route::post('/update_trip', 'tripController@update_trip')->name('update_trip');
});

Route::group(['middleware'=>['auth']], function() {
    Route::get('/', function () {
        return redirect('/home');
    });

    Route::get('/home', 'HomeController@index')->name('home');
});

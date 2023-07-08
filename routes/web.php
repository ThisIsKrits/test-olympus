<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/customer', 'CustomerController@index')->name('customer.get');
    Route::post('/customer', 'CustomerController@store')->name('customer.store');
    Route::post('/customer-delete', 'CustomerController@destroy')->name('customer.destroy');

    Route::get('/customer-data', 'CustomerController@data')->name('customer.data');

    // product
    Route::get("order",'ProductController@index')->name('history');


    // order
    Route::get('/order', 'OrderController@index')->name('order.get');
    Route::get('order-data', 'OrderController@data')->name('order.data');
    Route::get('/order-detail/{id}', 'OrderController@show')->name('order.show');
});

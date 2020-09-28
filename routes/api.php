<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::prefix('v1')->name('api.v1.')->namespace('Api\V1')->group(function(){
    Route::get('/status', function(){
        return response()->json(['status' => 'OK']);
    })->name('status');

    Route::apiResource('products','ProductsController')->only([
        'index','show'
    ]);

    // Route::get('/products','ProductsController@index')->name('products');
    // Route::get('/products','ProductsController@shw')->name('products.show');

    
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/carts', 'CartsController@index')->name('carts');
        Route::post('/carts/add/{id}', 'CartsController@store')->name('carts.add');
        Route::post('/carts/increase/{id}', 'CartsController@increase')->name('carts.increase');
        Route::post('/carts/decrease/{id}', 'CartsController@decrease')->name('carts.decrease');
        Route::post('/carts/delete/{id}', 'CartsController@destroy')->name('carts.delete');

        Route::get('/transactions', 'TransactionsController@index')->name('transactions');
        Route::get('/transaction/{id}', 'TransactionsController@show')->name('transactions.show');
        Route::post('/transaction/image_upload/{id}', 'TransactionsController@insertImage')->name('transactions.image.upload');
        Route::post('/transaction/create', 'TransactionsController@store')->name('transactions.create');
        Route::post('/transaction/create_one', 'TransactionsController@buy')->name('transactions.buy');
    });
});


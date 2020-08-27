<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ProductsController@index')->name('home');
Route::get('/show/{id}','ProductsController@show')->name('show');

Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/add/{id}', 'CartController@store')->name('cart.store');
Route::patch('/cart/increase/{id}', 'CartController@increase')->name('cart.increase');
Route::patch('/cart/decrease/{id}', 'CartController@decrease')->name('cart.decrease');
Route::delete('/cart/remove', 'CartController@destroy')->name('cart.destroy');


Route::get('admin/adminhome', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

Route::get('/checkout','TransactionController@index')->name('checkout');
Route::post('/checkout/pay','TransactionController@store')->name('transaction.store');
Route::get('/checkout/validate/{id}','TransactionController@showGuest')->name('transaction.show.guest');
Route::post('/insertImage/{id}','TransactionController@insertImage')->name('transaction.insert.image');

// Route::resource('/adminproduct', 'Admin\ProductController');
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
    // Route::get('adminhome', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
    Route::resource('adminproducts', 'AdminProductsController')->middleware('is_admin');
    Route::get('/transaction','AdminTransactionController@index')->name('transaction');
    Route::get('/detailtransaction/{id}','AdminTransactionController@show');
    Route::put('/transaction/update/{id}','AdminTransactionController@update')->name('admintransaction.update');
});

Route::get('images', 'ImageController@index');
Route::post('images', 'ImageController@store')->name('images.store');

Auth::routes();

Route::get('search', 'AutoCompleteController@index');
Route::get('autocomplete', 'AutoCompleteController@search')->name('autocomplete');

Route::get('cekongkir','HomeController@cekongkir');
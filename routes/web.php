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

Route::get('/buy/{id}', 'CartController@buy')->name('buy');

Route::get('/checkout','TransactionController@index')->name('checkout');
Route::get('/buy/{id}/checkout','TransactionController@indexBuy')->name('checkout.buy');


//PAY FROM CART
Route::post('/checkout/pay_guest','TransactionController@storeGuest')->name('transaction.storeGuest');
Route::post('/checkout/pay','TransactionController@storeAuth')->name('transaction.storeAuth');

//BUY DIRECTLY
Route::post('buy/checkout/pay','TransactionController@buy')->name('transaction.buy');
Route::get('/checkout/validate/{id}','TransactionController@show')->name('transaction.show');
Route::post('/insertImage/{id}','TransactionController@insertImage')->name('transaction.insert.image');

//CEK TRANSAKSI
Route::get('/cektransaksi','TransactionController@checkTransaction')->name('transaction.check');
Route::get('/cektransaksi/search','TransactionController@checkTransactionSearch')->name('transaction.check.search');
Route::get('/mytransaction/{id}', 'TransactionController@myTransaction')->name('mytransaction');
Route::get('/mytransaction/user/{id}','TransactionController@DetailMyTransaction')->name('mytransaction.user');


Route::get('admin/adminhome', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

// Route::resource('/adminproduct', 'Admin\ProductController');
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
    // Route::get('adminhome', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
    Route::resource('adminproducts', 'AdminProductsController')->middleware('is_admin');
    Route::get('/transaction','AdminTransactionController@index')->name('transaction');
    Route::get('/waiting','AdminTransactionController@waiting')->name('waiting');
    Route::get('/processing','AdminTransactionController@processing')->name('processing');
    Route::get('/confirmed','AdminTransactionController@confirmed')->name('confirmed');
    Route::get('/done','AdminTransactionController@done')->name('done');
    Route::get('/detailtransaction/{id}','AdminTransactionController@show');
    Route::put('/transaction/update/{id}','AdminTransactionController@update')->name('admintransaction.update');
    Route::get('/dashboard','AdminDashboardController@show')->name('admin.hom')->middleware('is_admin');
    Route::get('/invoice/{id}','AdminTransactionController@invoice')->name('invoice');
});

Route::get('images', 'ImageController@index');
Route::post('images', 'ImageController@store')->name('images.store');

Auth::routes();


Route::get('cekongkir','HomeController@cekongkir');
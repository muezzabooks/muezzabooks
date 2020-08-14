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

Route::get('/checkout','HomeController@checkout');

// Route::resource('/adminproduct', 'Admin\ProductController');
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
    Route::resource('adminproducts', 'AdminProductsController');
    Route::get('/transaction','AdminTransactionController@index')->name('transaction');
});


// Route::get('/addproduct', 'ProductsController@create');
// Route::post('/addproduct','ProductsController@store')->name('addproduct');

Route::get('images', 'ImageController@index');
Route::post('images', 'ImageController@store')->name('images.store');

Auth::routes();

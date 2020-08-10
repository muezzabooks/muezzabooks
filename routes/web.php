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
Route::get('/catalog', 'CatalogController@index');
Route::get('/detail','HomeController@detail')->name('detail');
Route::get('/show/{id}','ProductsController@show')->name('show');
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/checkout','HomeController@checkout');

Auth::routes();

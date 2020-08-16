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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', 'IndexController@index')->name('index');
Route::get('/products/{product}', 'ProductController@show')->name('products.show');

Route::get('/cart', 'CartController@index')->name('cart.index');

Route::get('/ajax/cart_items_count', 'CartController@getCartItemsCount');
Route::post('/ajax/add_to_cart', 'CartController@addToCart');
Route::post('/ajax/cart/decrease', 'CartController@decreaseCartItemQuantity');
Route::post('/ajax/cart/increase', 'CartController@increaseCartItemQuantity');
Route::get('/{category}', 'CategoryController@show')->name('categories.show');

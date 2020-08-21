<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/checkout', 'CheckoutController@checkoutPage')->name('orders.checkout');

Route::middleware('auth')->group(function () {
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
});

Auth::routes();

Route::get('/{category}', 'CategoryController@show')->name('categories.show');

Route::prefix('/ajax')->group(function() {
    Route::get('cart/count', 'CartController@getCartItemsCount');
    Route::get('checkout/validation_rules', 'CheckoutController@getValidationRules');
    Route::post('cart/{product}/add', 'CartController@addToCart');
    Route::post('cart/{cartItem}/decrease', 'CartController@decreaseCartItemQuantity');
    Route::post('cart/{cartItem}/increase', 'CartController@increaseCartItemQuantity');

    Route::post('checkout', 'CheckoutController@checkout');
});

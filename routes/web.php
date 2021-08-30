<?php

use Gloudemans\Shoppingcart\Facades\Cart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Roote Products
|--------------------------------------------------------------------------
*/
Route::resource('products', ProductController::class);

/*
|--------------------------------------------------------------------------
| Roote Panier
|--------------------------------------------------------------------------
*/

Route::resource('carts',CartController::class);


Route::get('/videpanier',function(){

    return Cart::destroy();
});
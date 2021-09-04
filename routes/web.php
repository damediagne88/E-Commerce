<?php

use Gloudemans\Shoppingcart\Facades\Cart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::resource('/', ProductController::class);
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

/*
|--------------------------------------------------------------------------
| Roote checkout 
|--------------------------------------------------------------------------
*/

Route::get('/paiement','CheckoutController@index')->name('checkout.index');
Route::post('/paiement','CheckoutController@store')->name('checkout.store');

Route::get('/merci',function(){
 return view('checkout.thank');
});
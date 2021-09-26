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
Route::get('/search','ProductController@search')->name('products.search');

/*
|--------------------------------------------------------------------------
| Roote Panier
|--------------------------------------------------------------------------
*/

Route::resource('carts',CartController::class);

Route::get('/carts','CartController@index')->name('carts.index');
Route::post('/carts/store','CartController@store')->name('carts.store');
Route::put('/carts/{rowId}','CartController@update')->name('carts.update');
Route::delete('/carts/{rowId}','CartController@destroy')->name('carts.destroy');
/*
|--------------------------------------------------------------------------
| Roote checkout 
|--------------------------------------------------------------------------
*/

Route::get('/paiement','CheckoutController@index')->name('checkout.index');
Route::post('/paiement','CheckoutController@store')->name('checkout.store');
Route::get('/merci','CheckoutController@thank')->name('checkout.thank');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

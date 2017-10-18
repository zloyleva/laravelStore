<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get( '/', [ 'as' => 'home', 'uses' => 'PagesController@home' ] );

Route::get( '/store', [ 'as' => 'store', 'uses' => 'ProductsController@store' ] );
Route::get( '/store/category/{slug}', [ 'as' => 'category', 'uses' => 'ProductsController@store' ] );
Route::get( '/store/search', [ 'as' => 'search', 'uses' => 'SearchProductsController@searchIndex' ] );

Route::group( [ 'middleware' => [ 'auth' ] ], function () {
	Route::get( '/cart', [ 'as' => 'cart', 'uses' => 'PagesController@showCard' ] );
} );

Route::group( [ 'middleware' => [ 'auth' ], 'prefix' => 'orders', 'as' => 'orders.' ], function () {
	Route::get( '/cart', [ 'as' => 'cart', 'uses' => 'PagesController@showCard' ] );
	Route::get( '/list', [ 'as' => 'list', 'uses' => 'OrdersController@listOrders' ] );
	Route::get( '/show/{id}', [ 'as' => 'show', 'uses' => 'PagesController@showOrder' ] );
} );

Route::group( [ 'middleware' => [ 'auth', 'admin' ], 'prefix' => 'admin', 'as' => 'admin.' ], function () {
	Route::get( '/orders', [ 'as' => 'ordersList', 'uses' => 'AdminDashboardController@listOrders' ] );
	Route::get( '/products', [ 'as' => 'addProducts', 'uses' => 'AdminDashboardController@addProducts' ] );
} );

Route::delete('/cart', [ 'as'=>'cart.delete', 'uses'=>'CartController@deleteCart']);

Auth::routes();

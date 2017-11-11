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
	Route::get( '/my_profile', [ 'as' => 'my_profile', 'uses' => 'PagesController@myProfile' ] );

	Route::get( '/cart', [ 'as' => 'cart', 'uses' => 'PagesController@showCard' ] );
	Route::delete('/cart', [ 'as'=>'cart.delete', 'uses'=>'CartController@deleteCart']);

	Route::post('/cart/add_item', [ 'as'=>'cart_item.add', 'uses'=>'CartController@setCartItemAmount']);
	Route::post('/cart/sub_item', [ 'as'=>'cart_item.sub', 'uses'=>'CartController@setCartItemAmount']);
	Route::delete('/cart/item', [ 'as'=>'cart_item.delete', 'uses'=>'CartController@deleteCartItem']);
} );

Route::group( [ 'middleware' => [ 'auth' ], 'prefix' => 'orders', 'as' => 'orders.' ], function () {
	Route::post( '/create', [ 'as' => 'create', 'uses' => 'OrdersController@createOrder' ] );
	Route::get( '/list', [ 'as' => 'list', 'uses' => 'OrdersController@listOrders' ] );
	Route::get( '/show/{id}', [ 'as' => 'show', 'uses' => 'PagesController@showOrder' ] );
} );

Route::group( [ 'middleware' => [ 'auth', 'admin' ], 'prefix' => 'admin', 'as' => 'admin.' ], function () {
	Route::get( '/orders', [ 'as' => 'ordersList', 'uses' => 'AdminDashboardController@listOrders' ] );
	Route::get( '/products', [ 'as' => 'addProducts', 'uses' => 'AdminDashboardController@addProducts' ] );

	Route::get( '/get_file', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@getFile' ] );
	Route::get( '/queue_method', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@queueMethod' ] );


	Route::post( '/products', [ 'as' => 'updateProducts', 'uses' => 'AddProductsController@updateProducts' ] );

} );

Auth::routes();

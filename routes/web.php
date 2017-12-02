<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get( '/', [ 'as' => 'home', 'uses' => 'PagesController@home' ] );
Route::get( '/how_to_buy', [ 'as' => 'how_to_buy', 'uses' => 'PagesController@howToBuy' ] );
Route::get( '/delivery', [ 'as' => 'delivery', 'uses' => 'PagesController@delivery' ] );

Route::get( '/store', [ 'as' => 'store', 'uses' => 'ProductsController@store' ] );
Route::get( '/store/category/{slug}', [ 'as' => 'category', 'uses' => 'ProductsController@store' ] );
Route::get( '/store/search', [ 'as' => 'search', 'uses' => 'SearchProductsController@searchIndex' ] );

Route::get( '/store/product/{slug}', [ 'as' => 'show_product', 'uses' => 'ProductsController@showProduct' ] );

Route::group( [ 'middleware' => [ 'auth' ] ], function () {
	Route::get( '/my_profile', [ 'as' => 'my_profile', 'uses' => 'PagesController@myProfile' ] );

	Route::get( '/cart', [ 'as' => 'cart', 'uses' => 'CartController@showCard' ] );
	Route::delete('/cart', [ 'as'=>'cart.delete', 'uses'=>'CartController@deleteCart']);

	Route::post('/cart/add_item', [ 'as'=>'cart_item.add', 'uses'=>'CartController@setCartItemAmount']);
	Route::post('/cart/sub_item', [ 'as'=>'cart_item.sub', 'uses'=>'CartController@setCartItemAmount']);
	Route::delete('/cart/item', [ 'as'=>'cart_item.delete', 'uses'=>'CartController@deleteCartItem']);
} );

Route::group( [ 'middleware' => [ 'auth' ], 'prefix' => 'orders', 'as' => 'orders.' ], function () {
	Route::post( '/create', [ 'as' => 'create', 'uses' => 'OrdersController@createOrder' ] );
	Route::get( '/list', [ 'as' => 'list', 'uses' => 'OrdersController@listOrders' ] );
	Route::get( '/show/{id}', [ 'as' => 'show', 'uses' => 'OrdersController@showOrder' ] );
} );

Route::group( [ 'middleware' => [ 'auth', 'admin' ], 'prefix' => 'admin', 'as' => 'admin.' ], function () {
	Route::get( '/orders', [ 'as' => 'ordersList', 'uses' => 'AdminDashboardController@listOrders' ] );
	Route::get( '/products', [ 'as' => 'addProducts', 'uses' => 'AdminDashboardController@addProducts' ] );

	Route::get( '/users', [ 'as' => 'users', 'uses' => 'AdminDashboardController@usersList' ] );
	Route::get( '/users/new', [ 'as' => 'users.new', 'uses' => 'UsersController@newUser' ] );

	Route::get( '/managers', [ 'as' => 'managers', 'uses' => 'AdminDashboardController@managersList' ] );

	Route::get( '/get_file', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@getFile' ] );
	Route::get( '/queue_method', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@queueMethod' ] );
	Route::get( '/send_email', [ 'as' => 'send_email', 'uses' => 'AdminDashboardController@sendEmail' ] );

	Route::post( '/products', [ 'as' => 'updateProducts', 'uses' => 'AddProductsController@updateProducts' ] );
} );

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

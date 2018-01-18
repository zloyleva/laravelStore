<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get( '/', [ 'as' => 'home', 'uses' => 'PagesController@home' ] );
Route::get( '/how_to_buy', [ 'as' => 'how_to_buy', 'uses' => 'PagesController@howToBuy' ] );
Route::get( '/delivery', [ 'as' => 'delivery', 'uses' => 'PagesController@delivery' ] );
Route::get( '/load_price', [ 'as' => 'load_price', 'uses' => 'PagesController@load_price' ] );
Route::get( '/contacts', [ 'as' => 'contacts', 'uses' => 'PagesController@contacts' ] );

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
	Route::get( '/', [ 'as' => 'list', 'uses' => 'OrdersController@listOrders' ] );
	Route::get( '/{id}', [ 'as' => 'show', 'uses' => 'OrdersController@showOrder' ] );
} );

Route::group( [ 'middleware' => [ 'auth', 'manager' ], 'prefix' => 'admin', 'as' => 'admin.' ], function () {
	Route::get( '/orders', [ 'as' => 'ordersList', 'uses' => 'AdminDashboardController@listOrders' ] );
	Route::get( '/orders/{id}', [ 'as' => 'ordersShow', 'uses' => 'AdminDashboardController@showOrder' ] );

	Route::get( '/products', [ 'as' => 'addProducts', 'uses' => 'AdminDashboardController@addProducts' ] );

	Route::get( '/users', [ 'as' => 'users.index', 'uses' => 'AdminDashboardController@usersList' ] );
	Route::get( '/users/create', [ 'as' => 'users.create', 'uses' => 'UsersController@createUser' ] );
	Route::get( '/users/{id}/edit', [ 'as' => 'users.edit', 'uses' => 'UsersController@editUser' ] );

	Route::get( '/managers', [ 'as' => 'managers', 'uses' => 'AdminDashboardController@managersList' ] );

	Route::get( '/notes', [ 'as' => 'notes.index', 'uses' => 'NotesController@notesIndex' ] );
	Route::get( '/notes/create', [ 'as' => 'notes.create', 'uses' => 'NotesController@notesCreate' ] );
	Route::post( '/notes', [ 'as' => 'notes.store', 'uses' => 'NotesController@notesStore' ] );

	Route::get( '/get_file', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@getFile' ] );
	Route::get( '/queue_method', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@queueMethod' ] );
	Route::get( '/send_email', [ 'as' => 'send_email', 'uses' => 'AdminDashboardController@sendEmail' ] );

	Route::post( '/products', [ 'as' => 'updateProducts', 'uses' => 'AddProductsController@updateProducts' ] );
} );

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

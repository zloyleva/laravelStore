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
Route::get( '/site_map', [ 'as' => 'site_map', 'uses' => 'PagesController@site_map' ] );

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

    Route::get( '/after_registration', [ 'as' => 'after_registration', 'uses' => 'PagesController@after_registration' ] );
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

	Route::get( '/send_email', [ 'as' => 'send_email', 'uses' => 'AdminDashboardController@sendEmail' ] );

	Route::post( '/products', [ 'as' => 'updateProducts', 'uses' => 'AddProductsController@updateProducts' ] );

    Route::get( '/sliders', [ 'as' => 'sliders.index', 'uses' => 'SlidersController@index' ] );
    Route::post( '/sliders', [ 'as' => 'sliders.store', 'uses' => 'SlidersController@store' ] );
    Route::get( '/sliders/create', [ 'as' => 'sliders.create', 'uses' => 'SlidersController@create' ] );
    Route::get( '/sliders/{id}/edit', [ 'as' => 'sliders.edit', 'uses' => 'SlidersController@edit' ] );
    Route::post( '/sliders/{id}', [ 'as' => 'sliders.edit', 'uses' => 'SlidersController@update' ] );

    Route::get( '/arrival', [ 'as' => 'arrival.index', 'uses' => 'ArrivalGoodsController@index' ] );
    Route::post( '/arrival', [ 'as' => 'arrival.index', 'uses' => 'ArrivalGoodsController@store' ] );
    Route::get( '/arrival/create', [ 'as' => 'arrival.create', 'uses' => 'ArrivalGoodsController@create' ] );
    Route::get( '/arrival/{id}/edit', [ 'as' => 'arrival.edit', 'uses' => 'ArrivalGoodsController@edit' ] );
    Route::post( '/arrival/{id}', [ 'as' => 'arrival.edit', 'uses' => 'ArrivalGoodsController@update' ] );
} );

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/get_updates', 'TelegramController@getUpdates');
Route::get('/postSendMessage', 'TelegramController@postSendMessage');

Route::get( '/get_file', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@getFile' ] );
Route::get( '/queue_method', [ 'as' => 'get_file', 'uses' => 'AdminDashboardController@queueMethod' ] );


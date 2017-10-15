<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ 'as'=>'home', 'uses'=>'PagesController@home']);

Route::get('/store', [ 'as'=>'store', 'uses'=>'ProductsController@store']);
Route::get('/store/category/{slug}', [ 'as'=>'category', 'uses'=>'ProductsController@category']);
Route::get('/cart', [ 'as'=>'cart', 'uses'=>'PagesController@showCard']);
Route::get('/store/search/{search}', [ 'as'=>'search', 'uses'=>'SearchProductsController@searchIndex']);

Route::group(['middleware' => ['auth'], 'prefix' => 'orders', 'as' => 'orders.'], function () {
  Route::get('/list', [ 'as'=>'list', 'uses'=>'PagesController@listOrders']);
  Route::get('/show/{id}', [ 'as'=>'show', 'uses'=>'PagesController@showOrder']);
});

Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/orders', [ 'as'=>'ordersList', 'uses'=>'AdminDashboardController@listOrders']);
  Route::get('/products', [ 'as'=>'addProducts', 'uses'=>'AdminDashboardController@addProducts']);
});

Auth::routes();

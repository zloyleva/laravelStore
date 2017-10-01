<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ 'as'=>'home', 'uses'=>'PagesController@home']);
Route::get('/store', [ 'as'=>'store', 'uses'=>'PagesController@store']);
Route::get('/cart', [ 'as'=>'cart', 'uses'=>'PagesController@showCard']);

Route::group(['middleware' => ['auth'], 'prefix' => 'orders', 'as' => 'orders.'], function () {
  Route::get('/list', [ 'as'=>'list', 'uses'=>'PagesController@listOrders']);
  Route::get('/show/{id}', [ 'as'=>'show', 'uses'=>'PagesController@showOrder']);
});

Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/orders', [ 'as'=>'list', 'uses'=>'AdminDashboardController@listOrders']);
});

Auth::routes();

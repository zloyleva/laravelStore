<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ 'as'=>'home', 'uses'=>'PagesController@home']);
Route::get('/store', [ 'as'=>'store', 'uses'=>'PagesController@store']);
Route::get('/cart', [ 'as'=>'cart', 'uses'=>'PagesController@showCard']);

Auth::routes();

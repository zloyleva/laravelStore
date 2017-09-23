<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ 'as'=>'home', 'uses'=>'PagesController@home']);
Route::get('/store', [ 'as'=>'store', 'uses'=>'PagesController@store']);

Auth::routes();

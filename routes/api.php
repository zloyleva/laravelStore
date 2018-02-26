<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('store/addtocart', [ 'as'=>'store.addtocart', 'uses'=>'CartController@addToCart']);
    Route::post('order', [ 'as'=>'store.order', 'uses'=>'OrdersController@createOrder']);

    Route::post('/my_profile/data', [ 'as'=>'my_profile.update_data', 'uses'=>'MyProfileController@updateMyProfileData']);
    Route::post('/my_profile/password', [ 'as'=>'my_profile.update_data', 'uses'=>'MyProfileController@updateMyProfilePassword']);

    Route::post( '/managers', [ 'as' => 'managers.store', 'uses' => 'ManagersController@store' ] ); // Add ADMIN middleware
    Route::post( '/users', [ 'as' => 'user.store', 'uses' => 'UsersController@store' ] ); // Add ADMIN middleware
    Route::post( '/users/{id}', [ 'as' => 'users.update', 'uses' => 'UsersController@updateUser' ] );

});

Route::post('send_cta', [ 'as'=>'notification.send_cta', 'uses'=>'NotificationController@send_cta']);

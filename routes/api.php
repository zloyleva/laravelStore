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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api', 'manager']], function () {
    Route::post('store/addtocart', [ 'as'=>'store.addtocart', 'uses'=>'CartController@addToCart']);
    Route::post('order', [ 'as'=>'store.order', 'uses'=>'OrdersController@createOrder']);

    Route::post('/my_profile/data', [ 'as'=>'my_profile.update_data', 'uses'=>'MyProfileController@updateMyProfileData']);
    Route::post('/my_profile/password', [ 'as'=>'my_profile.update_data', 'uses'=>'MyProfileController@updateMyProfilePassword']);

    Route::post( '/users/{id}', [ 'as' => 'users.update', 'uses' => 'UsersController@updateUser' ] );

    Route::post( '/managers', [ 'as' => 'managers', 'uses' => 'ManagersController@store' ] ); // Add ADMIN middleware
    Route::post( '/users', [ 'as' => 'managers', 'uses' => 'UsersController@store' ] ); // Add ADMIN middleware

});

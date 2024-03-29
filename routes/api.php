<?php


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


Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api',

], function () {
    Route::post('auth/login', 'AuthController@login'); // User login

    Route::group([
        'prefix' => 'auth',
        'middleware' => 'auth.jwt',

    ], function() {
        Route::get('/', 'AuthController@auth'); // Search login user
        Route::post('logout', 'AuthController@logout'); // User logout

    });

});
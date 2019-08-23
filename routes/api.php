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

Route::middleware('auth:api')->name('api.')->group(function () {
    Route::prefix('v1')->name('v1.')->namespace('Api')->group(function () {
        Route::get('orders', 'OrderController@readAll')->name('readAll');
        Route::get('orders/{orderId}', 'OrderController@read')->name('read');
        Route::post('orders', 'OrderController@create')->name('create');
    });
});
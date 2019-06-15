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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['namespace' => 'Home'], function () {
    Route::get('wx_index', 'SsqController@wxIndex');

    Route::group(['prefix' => 'ssq'], function () {
        Route::get('/', 'SsqController@index');
        Route::get('all', 'SsqController@all');
        Route::get('new', 'SsqController@new');
        Route::get('search', 'SsqController@search');
        Route::get('random', 'SsqController@random');
    });

    Route::group(['prefix' => 'dlt'], function () {
        Route::get('/', 'DltController@index');
        Route::get('all', 'DltController@all');
        Route::get('new', 'DltController@new');
        Route::get('search', 'DltController@search');
        Route::get('random', 'DltController@random');
    });
});
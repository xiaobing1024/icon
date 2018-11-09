<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/d', 'IndexController@download');
    Route::get('/d/{path}', 'IndexController@downloadFile');
    Route::post('/make_icon', 'IndexController@makeIcon');
    Route::get('/font', 'IndexController@font');


    Route::group(['prefix' => 'ssq'], function () {
        Route::get('/', 'SsqController@index');
        Route::get('/all', 'SsqController@all');
        Route::get('/new', 'SsqController@new');
        Route::get('/search', 'SsqController@search');
        Route::get('/random', 'SsqController@random');
    });

    Route::group(['prefix' => 'dlt'], function () {
        Route::get('/', 'DltController@index');
        Route::get('/all', 'DltController@all');
        Route::get('/new', 'DltController@new');
        Route::get('/search', 'DltController@search');
        Route::get('/random', 'DltController@random');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });


    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'IndexController@index');
        Route::get('/refresh_cache', 'IndexController@refreshCache');

        Route::resource('type', 'TypeController', ['except' => ['show', 'destroy']]);
        Route::resource('icon', 'IconController', ['except' => ['show', 'destroy']]);
        Route::resource('map', 'MapController', ['except' => ['show', 'destroy']]);
        Route::delete('temp/delete_path', 'TempController@deletePath');
        Route::resource('temp', 'TempController', ['only' => ['index', 'destroy']]);
        Route::get('/phpinfo', 'IndexController@phpinfo');
        Route::resource('font', 'FontController');
    });

});

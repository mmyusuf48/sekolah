<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/students','students@index');
    Route::post('/students/add','students@add');
    Route::post('/students/edit', 'students@edit');
    Route::get('/students/detail/{id}', 'students@detail');
    Route::get('/students/delete', 'students@delete');
// });

    Route::post('/image','ImageController@index');
    Route::get('/image/show','ImageController@show');

    Route::get('/class','ClassController@index');
    Route::post('/class/add','ClassController@add');
    Route::post('/class/edit', 'ClassController@edit');
    Route::get('/class/detail/{id}', 'ClassController@detail');
    Route::get('/class/delete', 'ClassController@delete');

    Route::get('/login','loginController@index');
    Route::post('/login/add','loginController@add');



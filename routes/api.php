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
    Route::get('/students/{id}', 'students@detail');
    Route::get('/students/delete', 'students@delete');
// });

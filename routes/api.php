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

//Route::resource('jobs', 'JobController');

Route::get('jobs/list', 'JobController@index');
Route::get('jobs/get/{id}', 'JobController@show');

Route::post('jobs/create', 'JobController@create');

Route::post('jobs/take/{processor}', 'JobController@take');
Route::post('jobs/close/{id}', 'JobController@close');

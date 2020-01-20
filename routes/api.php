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

Route::post('/user', 'UserController@createUser' );
Route::post('/user/generateToken/{id}', 'UserController@generateToken' );
Route::get('/users', 'UserController@getUsers' );
Route::post('/animal', 'AnimalController@createAnimal' );


Route::middleware('auth:api')->get('/user/{id}', 'UserController@getUser' );
Route::middleware('auth:api')->put('/user/{id}', 'UserController@UpdateUser' );
Route::middleware('auth:api')->delete('/user/{id}', 'UserController@deleteUser' );
Route::post('/user/login', 'UserController@loginUser' );

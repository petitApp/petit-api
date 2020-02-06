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

//USER ROUTES

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', 'UserController@createUser' );
Route::post('/user/generateToken/{id}', 'UserController@generateToken' );
Route::get('/users', 'UserController@getUsers' );
Route::post('/user/login', 'UserController@loginUser' );
Route::get('/user/one/{id}', 'UserController@getUser' );

Route::post('/user/password/reset', 'UserController@sendMail');


// Route::middleware('auth:api')->get('/user/{id}', 'UserController@getUser' );
// Route::middleware('auth:api')->put('/user/{id}', 'UserController@UpdateUser' );
// Route::middleware('auth:api')->delete('/user/{id}', 'UserController@deleteUser' );

//ANIMAL ROUTES
Route::post('/animal', 'AnimalController@createAnimal' );
Route::post('/animal/{id}', 'AnimalController@updateAnimal' );
Route::get('/animal/{id}', 'AnimalController@getAnimal' );
Route::get('/animals', 'AnimalController@getAllAnimals' );


<?php

/*
|--------------------------------------------------------------------------
| API ROUTES - MOBILE DEVICES SERVICE
|--------------------------------------------------------------------------
| Pet It App
|
| Api routes for the app functionalities.
|
*/

use Illuminate\Http\Request;

//BASIC ROUTES & VIEWS
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//USER SERVICE
Route::post('/user', 'UserController@createUser' );
Route::post('/user/generateToken/{id}', 'UserController@generateToken' );
Route::post('/user/login', 'UserController@loginUser' );
Route::get('/user/one/{id}', 'UserController@getUser' );
Route::put('/user/{id}', 'UserController@updateUser' );

Route::post('/user/password/reset', 'UserController@sendMail');

// Route::middleware('auth:api')->get('/user/{id}', 'UserController@getUser' );
// Route::middleware('auth:api')->put('/user/{id}', 'UserController@UpdateUser' );
// Route::middleware('auth:api')->delete('/user/{id}', 'UserController@deleteUser' );

//ANIMAL SERVICE
Route::post('/animal', 'AnimalController@createAnimal' );
Route::post('/animal/{id}', 'AnimalController@updateAnimal' );
Route::get('/animal/{id}', 'AnimalController@getAnimal' );
Route::get('/animals', 'AnimalController@getAllAnimals' );
Route::get('/animals/type/{type}', 'AnimalController@getAnimalByType' );
Route::get('/animals/breed/{breed}', 'AnimalController@getAnimalByBreed');
Route::get('/animals/age/{age}', 'AnimalController@getAnimalByAge' );
Route::get('/animals/distance/{latitude}/{longitude}/{distance}', 'AnimalController@getAnimalByDistance' );
Route::get('/animals/filtered', 'AnimalController@getFilterAnimal' );
Route::get('/animal/user/{id}', 'AnimalController@getUserAnimals' );


//CHAT SERVICE
Route::post('/chat/create', 'ChatContoller@createChat' );
Route::get('/chat/mesages/{id}', 'ChatContoller@getChat' );
Route::post('/chat/add/message', 'ChatContoller@createMessage' );
Route::get('/chat/user/{id}', 'ChatContoller@getAllUserChats' );
Route::post('/chat/deactivate/{id}', 'ChatContoller@deactivateChat' );
//FAVORITES SERVICE
Route::post('/add/favorite', 'FavoritesController@createFavoriteAnimal');
Route::get('/favorites/{id}', 'FavoritesController@getAllFavoritesByUser');
Route::get('/favorites', 'FavoritesController@getOneFavoriteByUser');

Route::delete('/delete/favorite', 'FavoritesController@deleteFavoriteAnimal');




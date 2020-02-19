<?php

/*
|--------------------------------------------------------------------------
| WEB ROUTES - ADMIN - BASIC ROUTES & VIEWS
|--------------------------------------------------------------------------
| Pet It App
|
| Web routes for the admin panel functionalities.
|
*/

use Illuminate\Http\Request;

//BASIC ROUTES & VIEWS
Route::get('/', function () {
    return view('welcome');
});
Route::get('/user/create', function () {
    return view('createuser');
});
Route::get('/animal/create', function () {
    return view('createanimal');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//ADMIN - USERS ROUTES
Route::post('/user/create', 'UserControllerAdmin@createUser');
Route::get('/user/update', 'UserControllerAdmin@getUsers');


Route::post('/user/update', 'UserControllerAdmin@updateUser');
Route::post('/animal/update', 'AnimalControllerAdmin@updateAnimalAdmin');


//ADMIN - ANIMALS ROUTES
Route::post('/animal/create', 'AnimalControllerAdmin@createAnimalAdmin');
Route::get('/animal/update', 'AnimalControllerAdmin@getAnimalsAdmin');

Route::post('/animal/{id}', 'AnimalController@updateAnimal');
Route::get('/animal/{id}', 'AnimalController@getAnimal');
Route::get('/animals', 'AnimalController@getAllAnimals');
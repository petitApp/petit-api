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

/*--------- ADMIN - USERS ROUTES ---------*/

//create an user
Route::post('/user/create', 'UserControllerAdmin@createUser');

//All users
Route::get('/users', 'UserControllerAdmin@getUsersAdmin');

//Update an user by id
Route::post('/user/{id}/update', 'UserControllerAdmin@updateUserById');
//GET to populate an user data by a given ID.
//Used before and after updating an animal in order to show feedback to the admin
Route::get('/user/{id}/update', 'userControllerAdmin@getUserById');


//TODO
//Rutas antiguas evaluarrr
// Route::post('/user/update', 'UserControllerAdmin@updateUser');
// Route::post('/animal/update', 'AnimalControllerAdmin@updateAnimalAdmin');
// Route::get('/user/update', 'UserControllerAdmin@getUsers');


/* --------- ADMIN - ANIMALS ROUTES --------- */
 
//Create an animal 
Route::post('/animal/create', 'AnimalControllerAdmin@createAnimalAdmin');

//All animals
Route::get('/animals', 'AnimalControllerAdmin@getAnimalsAdmin');

//UPDATE an animal by ID 
Route::get('animal/{id}/update', 'AnimalControllerAdmin@getAnimalById');
Route::post('animal/{id}/update', 'AnimalControllerAdmin@updateAnimalById');

//GET to populate an animal data by a given ID. 
//It is used before and after updating an animal in order to show feedback to the admin  

//TODO
//Ruta antigua Comprobar validez actual
// Route::post('/animal/{id}', 'AnimalController@updateAnimal');
// Route::get('/animal/{id}', 'AnimalController@getAnimal');
// Route::get('/animals', 'AnimalController@getAllAnimals');

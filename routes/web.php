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

use Illuminate\Http\Request;

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
Route::get('/users/update', 'UserControllerAdmin@getUsers');


Route::post('/user/update', 'UserControllerAdmin@updateUser');
Route::post('/animal/update', 'AnimalControllerAdmin@updateAnimalAdmin');


//ADMIN - ANIMALS ROUTES
Route::post('/animal/create', 'AnimalControllerAdmin@createAnimalAdmin');
Route::get('/animal/update', 'AnimalControllerAdmin@getAnimalsAdmin');

Route::post('/animal/{id}', 'AnimalController@updateAnimal');
Route::get('/animal/{id}', 'AnimalController@getAnimal');
Route::get('/animals', 'AnimalController@getAllAnimals');
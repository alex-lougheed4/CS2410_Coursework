<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    //get data from db for animals and have a button on each animal
    return view('home');
});

Route::get('/account', function() {
  return view('account');
});

Route::get('/staffportal', function() {
  return view('staffportal');
});


Route::get('display','App\Http\Controllers\AnimalController@display')
->name('display_animal');

Route::get('display_adoptions','App\Http\Controllers\AdoptionController@display')
->name('display_adoption');

Route::post('create/{animal}','App\Http\Controllers\AdoptionController@store')
->name('create_adoption');

use App\Http\Controllers\AnimalController;
Route::resource('animals',AnimalController::class);

use App\Http\Controllers\AdoptionController;
Route::resource('adoptions',AdoptionController::class);


Route::get('list', 'App\Http\Controllers\AnimalController@list');
Route::get('show/{id}', 'App\Http\Controllers\AnimalController@show');
Route::get('approve/{id}', 'App\Http\Controllers\AdoptionController@approveAdoption')->name('approve');
Route::get('deny/{id}', 'App\Http\Controllers\AdoptionController@denyRequest')->name('deny');
Route::get('sortby','App\Http\Controllers\AnimalController@index')->name('sortby');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

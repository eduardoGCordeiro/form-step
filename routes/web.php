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

/*  DEFAULT ROUTE */

Route::get('/', function () {
    return view('welcome');
});

/* USER ROUTES */
Route::group([
    'as'     => 'user.',
    'prefix' => 'user'
], function () {
    Route::get('/', ["uses" => '\App\Http\Controllers\UserController@index', "as" => "home"]);
    Route::get('/form', ["uses" => '\App\Http\Controllers\UserController@form', "as" => "form"]);
    Route::get('/form/{user}', ["uses" => '\App\Http\Controllers\UserController@form', "as" => "edit"]);
    Route::get('/delete/{user}', ["uses" => '\App\Http\Controllers\UserController@destroy', "as" => "delete"]);
});

<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'as'     => 'user.',
    'prefix' => 'user'
], function () {
    Route::post('/', ["uses" => '\App\Http\Controllers\Api\UserController@save', "as" => "save"]);
    Route::post('/{item}', ["uses" => '\App\Http\Controllers\Api\UserController@save', "as" => "update"]);
    Route::get('/details', ["uses" => '\App\Http\Controllers\Api\UserController@details', "as" => "details"]);
});

Route::group([
    'as'     => 'phone.',
    'prefix' => 'phone'
], function () {
    Route::post('/{item}', ["uses" => '\App\Http\Controllers\Api\PhoneController@save', "as" => "update"]);
});

Route::group([
    'as'     => 'address.',
    'prefix' => 'address'
], function () {
    Route::post('/{item}', ["uses" => '\App\Http\Controllers\Api\AddressController@save', "as" => "update"]);
});

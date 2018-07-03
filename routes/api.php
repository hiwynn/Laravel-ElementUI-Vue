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

Route::middleware('api')->post('/phone/search', 'PhoneListController@search');
Route::middleware('api')->post('/phone/add', 'PhoneListController@add');
Route::middleware('api')->post('/phone/delete/{id}', 'PhoneListController@deletePhone');
Route::middleware('api')->post('/phone/update/{id}', 'PhoneListController@updatePhone');





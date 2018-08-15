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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'PhoneListController@index');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'PhoneListController@index');

Route::get('/manage-user', 'ManageUserController@index');

Auth::routes();

Route::get('/excel/export', 'ExcelController@exportPhone');
Route::post('/excel/import', 'ExcelController@importPhone');
Route::get('/excel/export/template', 'ExcelController@exportTemplate');
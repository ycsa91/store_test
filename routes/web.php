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

Route::get('/', function () {
    return view('client');
    // return view('welcome');
});

Route::get('/clients', 'ClientController@index');
Route::post('/new_client', 'ClientController@create');
Route::post('/delete_client/{id}', 'ClientController@delete');
Route::post('/edit_client/{id}', 'ClientController@edit');

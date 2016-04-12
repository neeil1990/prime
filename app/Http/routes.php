<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

Route::get('/personal', ['as' => 'personal', 'uses' => 'HomeController@personal']);

Route::get('/personal/create', ['as' => 'createPersonal', 'uses' => 'HomeController@createPersonalForm']);
Route::post('/create-personal', ['as' => 'create', 'uses' => 'HomeController@create']);
Route::post('/update-personal', ['as' => 'update', 'uses' => 'HomeController@update']);

Route::post('/delite', ['as' => 'delite', 'uses' => 'HomeController@delite']);
Route::get('/personal/{id}/edit', ['as' => 'edit', 'uses' => 'HomeController@edit']);



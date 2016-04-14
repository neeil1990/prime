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



Route::get('/pass-context', ['as' => 'pass_context', 'uses' => 'HomeController@passContext']);
Route::get('/pass-context/create', ['as' => 'passContextCreatForm', 'uses' => 'HomeController@passContextCreatForm']);

Route::post('/create-pass-context', ['as' => 'createPassContext', 'uses' => 'HomeController@createPassContext']);
Route::post('/delite-pass-context', ['as' => 'delitePassContext', 'uses' => 'HomeController@delitePassContext']);
Route::get('/pass-context/{id}/edit', ['as' => 'editPassContext', 'uses' => 'HomeController@editPassContext']);
Route::post('/update-create-pass-context', ['as' => 'updatePassContext', 'uses' => 'HomeController@updatePassContext']);


//таблица группы
Route::get('/groups/create', ['as' => 'createGroupForm', 'uses' => 'HomeController@createGroupForm']);
Route::post('/create-groups', ['as' => 'createGroups', 'uses' => 'HomeController@createGroups']);
Route::post('/update-groups', ['as' => 'updateGroups', 'uses' => 'HomeController@updateGroups']);
Route::get('/groups/{id}/edit', ['as' => 'editGroupForm', 'uses' => 'HomeController@editGroupForm']);
Route::post('/delite-group', ['as' => 'deliteGroup', 'uses' => 'HomeController@deliteGroup']);
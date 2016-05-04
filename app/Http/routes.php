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


Route::get('/view-seo-and-context-project/{id}', ['as' => 'viewSeoAndContextProject', 'uses' => 'HomeController@viewSeoAndContextProject']);


Route::post('/show-procent-group', ['as' => 'showProcentGroup', 'uses' => 'HomeController@showProcentGroup']);
Route::post('/show-procent-users', ['as' => 'showProcentUsers', 'uses' => 'HomeController@showProcentUsers']);


Route::post('/show-level-group', ['as' => 'showLevelGroup', 'uses' => 'HomeController@showLevelGroup']);




Route::post('/update-group-positions', ['as' => 'updateGroupPositions', 'uses' => 'HomeController@updateGroupPositions']);
Route::post('/update-personal-positions', ['as' => 'updatePersonalPositions', 'uses' => 'HomeController@updatePersonalPositions']);
Route::post('/update-pass-seo-positions', ['as' => 'updatePassSeoPositions', 'uses' => 'HomeController@updatePassSeoPositions']);
Route::post('/update-pass-dev-positions', ['as' => 'updatePassDevPositions', 'uses' => 'HomeController@updatePassDevPositions']);
Route::post('/update-pass-context-positions', ['as' => 'updatePassContextPositions', 'uses' => 'HomeController@updatePassContextPositions']);
Route::post('/update-project-seo-positions', ['as' => 'UpdateProjectSeoPosition', 'uses' => 'HomeController@UpdateProjectSeoPosition']);
Route::post('/update-project-context-positions', ['as' => 'updateProjectContextPositions', 'uses' => 'HomeController@updateProjectContextPositions']);

Route::get('/personal/create', ['as' => 'createPersonal', 'uses' => 'HomeController@createPersonalForm']);
Route::post('/create-personal', ['as' => 'create', 'uses' => 'HomeController@create']);
Route::post('/update-personal', ['as' => 'update', 'uses' => 'HomeController@update']);

Route::post('/delite', ['as' => 'delite', 'uses' => 'HomeController@delite']);
Route::get('/personal/{id}/edit', ['as' => 'edit', 'uses' => 'HomeController@edit']);



Route::get('/pass-seo', ['as' => 'pass_context', 'uses' => 'HomeController@passSEO']);
Route::get('/pass-seo/create', ['as' => 'passSeoCreatForm', 'uses' => 'HomeController@passSeoCreatForm']);

Route::post('/create-pass-seo', ['as' => 'createPassContext', 'uses' => 'HomeController@createPassSeo']);
Route::post('/delite-pass-seo', ['as' => 'delitePassContext', 'uses' => 'HomeController@delitePassSeo']);
Route::get('/pass-seo/{id}/edit', ['as' => 'editPassContext', 'uses' => 'HomeController@editPassSeo']);
Route::post('/update-create-pass-seo', ['as' => 'updatePassContext', 'uses' => 'HomeController@updatePassSeo']);


//������� ������
Route::get('/groups/create', ['as' => 'createGroupForm', 'uses' => 'HomeController@createGroupForm']);
Route::post('/create-groups', ['as' => 'createGroups', 'uses' => 'HomeController@createGroups']);
Route::post('/update-groups', ['as' => 'updateGroups', 'uses' => 'HomeController@updateGroups']);
Route::get('/groups/{id}/edit', ['as' => 'editGroupForm', 'uses' => 'HomeController@editGroupForm']);
Route::post('/delite-group', ['as' => 'deliteGroup', 'uses' => 'HomeController@deliteGroup']);

//������ ��������
Route::get('/pass-context', ['as' => 'pass_context', 'uses' => 'HomeController@passContext']);
Route::get('/pass-context/create', ['as' => 'passContextCreatForm', 'uses' => 'HomeController@passContextCreatsForm']);

Route::post('/create-pass-context', ['as' => 'createPassContext', 'uses' => 'HomeController@createPassContext']);
Route::post('/delite-pass-context', ['as' => 'delitePassContext', 'uses' => 'HomeController@delitePassContext']);
Route::get('/pass-context/{id}/edit', ['as' => 'editPassContext', 'uses' => 'HomeController@editPassContext']);
Route::post('/update-create-pass-context', ['as' => 'updatePassContext', 'uses' => 'HomeController@updatePassContext']);

//������ ��� ������������
Route::get('/pass-dev', ['as' => 'passDev', 'uses' => 'HomeController@passDev']);
Route::get('/pass-dev/create', ['as' => 'passDevCreatForm', 'uses' => 'HomeController@passDevCreatForm']);
Route::post('/create-pass-dev', ['as' => 'createPassDev', 'uses' => 'HomeController@createPassDev']);
Route::post('/delite-pass-dev', ['as' => 'delitePassDev', 'uses' => 'HomeController@delitePassDev']);
Route::get('/pass-dev/{id}/edit', ['as' => 'editPassDev', 'uses' => 'HomeController@editPassDev']);
Route::post('/update-create-pass-dev', ['as' => 'updatePassDev', 'uses' => 'HomeController@updatePassDev']);


//������ ������
Route::get('/work-graffik', ['as' => 'WorkGraff', 'uses' => 'HomeController@WorkGraff']);

//������� seo
Route::get('/project-seo', ['as' => 'projectSeo', 'uses' => 'HomeController@projectSeo']);
Route::get('/project-seo/create', ['as' => 'projectSeoCreateForm', 'uses' => 'HomeController@projectSeoCreateForm']);
Route::post('/create-project-seo', ['as' => 'createProjectSeo', 'uses' => 'HomeController@createProjectSeo']);
Route::post('/delite-project-seo', ['as' => 'deliteProjectSeo', 'uses' => 'HomeController@deliteProjectSeo']);
Route::get('/project-seo/{id}/edit', ['as' => 'editProjectSeo', 'uses' => 'HomeController@editProjectSeo']);
Route::post('/update-project-seo', ['as' => 'updateProjectSeo', 'uses' => 'HomeController@updateProjectSeo']);
//������� context
Route::get('/project-context', ['as' => 'projectContext', 'uses' => 'HomeController@projectContext']);
Route::get('/project-context/create', ['as' => 'projectContextCreateForm', 'uses' => 'HomeController@projectContextCreateForm']);
Route::post('/create-project-context', ['as' => 'createProjectContext', 'uses' => 'HomeController@createProjectContext']);
Route::post('/delite-project-context', ['as' => 'deliteProjectContext', 'uses' => 'HomeController@deliteProjectContext']);
Route::get('/project-context/{id}/edit', ['as' => 'editProjectContext', 'uses' => 'HomeController@editProjectContext']);
Route::post('/update-project-context', ['as' => 'updateProjectContext', 'uses' => 'HomeController@updateProjectContext']);



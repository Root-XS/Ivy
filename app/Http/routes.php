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

Route::get('/', 'IndexController@getIndex');
Route::auth();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@getIndex');

    Route::controller('/people', 'PeopleController');
    Route::get('/people/edit/{id}', 'PeopleController@getEdit');
    Route::post('/people/edit/{id}', 'PeopleController@postEdit');

    Route::controller('/groups', 'GroupsController');
    Route::get('/groups/edit/{id}', 'GroupsController@getEdit');
    Route::post('/groups/edit/{id}', 'GroupsController@postEdit');
    Route::get('/groups/tag/{iTagId}', 'GroupsController@getTag');
});

// DYNAMIC MODULE ROUTING
Route::any(
    '/{module}/{controller?}/{action?}',
    function ($strModule, $strController = 'index', $strAction = 'index') {
        Route::controller($strAction, $strModule . '\\' . $strController . 'Controller');
    }
);

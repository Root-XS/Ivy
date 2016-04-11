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

Route::get('/', function () {
    return view('welcome');
});

// STATIC ROUTES GO HERE

// DYNAMIC MODULE ROUTING
Route::any(
    '/{module}/{controller?}/{action?}',
    function ($strModule, $strController = 'index', $strAction = 'index') {
        Route::controller($strAction, $strModule . '\\' . $strController . 'Controller');
    }
);

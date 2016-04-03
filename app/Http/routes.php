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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('change_password', 'HomeController@getChangePassword');
    Route::post('change_password', 'HomeController@storeChangePassword');

    Route::get('receive_mail', 'HomeController@getReceiveMail');
    Route::post('receive_mail', 'HomeController@storeReceiveMail');

    Route::get('/calendar', 'CalendarController@index');
    Route::get('/calendar/{year}/{month}/{day}', 'CalendarController@get');
    Route::get('/calendar/{year?}/{month?}', 'CalendarController@index');

    //Route::post('/appointments', 'AppointmentController@store');
    //Route::get('/appointments/create', 'AppointmentController@create');
    Route::get('appointments/ics/{id}', 'AppointmentController@getIcs');
    Route::resource('appointments', 'AppointmentController');
});

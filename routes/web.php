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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'],
    function () {

        Route::get('user/{id}/change-user-status', 'UsersController@changeUserStatus');

        Route::group(['prefix' => 'profile'],
            function () {
                Route::get('', 'UsersController@profile');
                Route::post('', 'UsersController@updateProfile');
                Route::post('password', 'UsersController@updatePassword');
            });

        Route::get('home', 'HomeController@index');

        Route::post('uploads/upload-avatar', 'UsersController@uploadAnyUserAvatar');

        Route::post('get-cities/{id}', 'StatesController@getCities');

        #########################################################################
        # Admin
        #########################################################################
        Route::group([
            'middleware' => 'admin',
            'prefix'     => 'admin'
        ], function () {

            Route::get('dashboard', 'HomeController@dashboard');
            Route::get('audits', 'AuditsController@index');

            Route::group(['prefix' => 'users'],
                function () {
                    Route::get('', 'UsersController@index');
                    Route::get('{id}/edit', 'UsersController@edit');
                    Route::post('{id}/edit', 'UsersController@update');
                    Route::get('{id}/delete', 'UsersController@destroy');
                    Route::post('create', 'UsersController@store');
                    Route::get('create', 'UsersController@create');
                });

            Route::group(['prefix' => 'logs'],
                function () {
                    Route::get('', 'LogsController@index');
                    Route::get('{id}/mark-as-seen', 'LogsController@markAsSeen');
                    Route::get('visualize-all', 'LogsController@visualizeAll');
                });

            Route::group(['prefix' => 'schedules'],
                function () {
                    Route::get('', 'SchedulesController@index');
                    Route::get('calendar', 'SchedulesController@calendar');
                    Route::post('calendar-ajax', 'SchedulesController@calendar');
                    Route::post('create', 'SchedulesController@store');
                    Route::get('create', 'SchedulesController@create');
                });

            Route::group(['prefix' => 'patients'],
                function () {
                    Route::get('', 'PatientsController@index');
                    Route::get('{id}/edit', 'PatientsController@edit');
                    Route::post('{id}/edit', 'PatientsController@update');
                    Route::get('{id}/delete', 'PatientsController@destroy');
                    Route::post('create', 'PatientsController@store');
                    Route::get('create', 'PatientsController@create');
                });
        });

        #########################################################################
        # Doctor
        #########################################################################
        Route::group([
            'middleware' => 'doctor',
            'prefix'     => 'doctor'
        ], function () {

            Route::get('dashboard', 'HomeController@dashboard');

            Route::group(['prefix' => 'patients'],
                function () {
                    Route::get('', 'PatientsController@index');
                    Route::get('{id}/edit', 'PatientsController@edit');
                    Route::post('{id}/edit', 'PatientsController@update');
                    Route::get('{id}/delete', 'PatientsController@destroy');
                    Route::post('create', 'PatientsController@store');
                    Route::get('create', 'PatientsController@create');
                });

            Route::group(['prefix' => 'logs'],
                function () {
                    Route::get('', 'LogsController@index');
                    Route::get('{id}/mark-as-seen', 'LogsController@markAsSeen');
                    Route::get('visualize-all', 'LogsController@visualizeAll');
                });

            Route::group(['prefix' => 'schedules'],
                function () {
                    Route::get('', 'SchedulesController@index');
                    Route::get('calendar', 'SchedulesController@calendar');
                    Route::post('calendar-ajax', 'SchedulesController@calendar');
                });
        });

    });

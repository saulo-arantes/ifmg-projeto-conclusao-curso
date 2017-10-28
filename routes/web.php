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
use App\Entities\User;

Route::get('/', function () {
    return view('auth/login');
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

	        Route::group(['prefix' => 'notifications'],
		        function () {
			        Route::get('', 'NotificationsController@index')->name('notifications.index');
			        Route::get('visualize-all', 'NotificationsController@visualizeAll')->name('visualizeAll');
		        });

            Route::group(['prefix' => 'schedules'],
                function () {
                    Route::get('', 'SchedulesController@index');
                    Route::get('calendar', 'SchedulesController@calendar');
                    Route::get('create/appointment', 'SchedulesController@createAppointment')->name('appointment');
                    Route::get('create/scheduling', 'SchedulesController@createScheduling')->name('scheduling');
                    Route::post('calendar-ajax', 'SchedulesController@calendarAjax');
                    Route::post('create', 'SchedulesController@store');
	                Route::get('{id}/edit/appointment', 'SchedulesController@editAppointment');
	                Route::get('{id}/edit/scheduling', 'SchedulesController@editScheduling');
	                Route::post('{id}/edit', 'SchedulesController@update');
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

            Route::group(['prefix' => 'document/types'],
                function () {
                    Route::get('create', 'DocumentTypesController@create');
                    Route::post('create', 'DocumentTypesController@store');
                    Route::get('', 'DocumentTypesController@index');
                    Route::get('{id}/edit', 'DocumentTypesController@edit');
                    Route::put('{id}/edit', 'DocumentTypesController@update');
                });

            Route::get('document', 'DocumentTypesController@generateDocument');

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


	        Route::group(['prefix' => 'schedules'],
		        function () {
			        Route::get('', 'SchedulesController@index');
			        Route::get('calendar', 'SchedulesController@calendar');
			        Route::get('create/appointment', 'SchedulesController@createAppointment');
			        Route::get('create/scheduling', 'SchedulesController@createScheduling');
			        Route::post('calendar-ajax', 'SchedulesController@calendarAjax');
			        Route::post('create', 'SchedulesController@store');
			        Route::get('{id}/edit', 'SchedulesController@edit');
			        Route::post('{id}/edit', 'SchedulesController@update');
		        });

	        Route::group(['prefix' => 'document/types'],
		        function () {
			        Route::get('create', 'DocumentTypesController@create');
			        Route::post('create', 'DocumentTypesController@store');
			        Route::get('', 'DocumentTypesController@index');
			        Route::get('{id}/edit', 'DocumentTypesController@edit');
			        Route::put('{id}/edit', 'DocumentTypesController@update');
		        });

	        Route::get('document', 'DocumentTypesController@generateDocument');
        });

	    #########################################################################
	    # Secretary
	    #########################################################################
	    Route::group([
		    'middleware' => 'secretary',
		    'prefix'     => 'secretary'
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

		    Route::group(['prefix' => 'schedules'],
			    function () {
				    Route::get('', 'SchedulesController@index');
				    Route::get('calendar', 'SchedulesController@calendar');
				    Route::get('create/appointment', 'SchedulesController@createAppointment');
				    Route::get('create/scheduling', 'SchedulesController@createScheduling');
				    Route::post('calendar-ajax', 'SchedulesController@calendarAjax');
				    Route::post('create', 'SchedulesController@store');
				    Route::get('{id}/edit', 'SchedulesController@edit');
				    Route::post('{id}/edit', 'SchedulesController@update');
			    });
	    });
    });

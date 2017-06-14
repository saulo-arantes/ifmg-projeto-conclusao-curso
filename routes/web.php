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
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'],
    function() {
        Route::group(['prefix' => 'profile'],
            function() {
                Route::get('', 'UsersController@profile');
                Route::post('', 'UsersController@updateProfile');
                Route::post('password', 'UsersController@updatePassword');
                Route::post('upload', 'UsersController@uploadProfilePicture');
            });

        Route::group([
            'middleware' => 'admin',
            'prefix' => 'admin'
        ], function() {

            Route::get('dashboard', 'HomeController@dashboard');

            Route::group(['prefix' => 'administrators'],
                function() {
                    Route::get('', 'AdministratorsController@indexAdministrators');
                    Route::get('{id}/edit', 'AdministratorsController@editAdministrator');
                    Route::post('{id}/edit', 'AdministratorsController@updateAdministrator');
                    Route::get('{id}/delete', 'AdministratorsController@destroy');
                    Route::post('create', 'AdministratorsController@storeAdministrator');
                    Route::get('create', 'AdministratorsController@create');
                });

        Route::group(['prefix' => 'logs'],
            function () {
                Route::get('', 'LogsController@index');
                Route::get('{id}/mark-as-seen', 'LogsController@markAsSeen');
                Route::get('visualize-all', 'LogsController@visualizeAll');
            });
        });

});

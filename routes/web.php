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
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'],
    function () {
        Route::get('home', 'HomeController@index');
        Route::group(['prefix' => 'profile'],
            function () {
                Route::get('', 'UsersController@profile');
                Route::post('', 'UsersController@update');
                Route::post('password', 'UsersController@updatePassword');
                Route::post('upload', 'UsersController@uploadProfilePicture');
            });

        Route::group([
            'middleware' => 'admin',
            'prefix'     => 'admin'
        ], function () {

            Route::get('dashboard', 'HomeController@dashboard');

            Route::group(['prefix' => 'administrators'],
                function () {
                    Route::get('', 'AdministratorsController@index');
                    Route::get('{id}/edit', 'AdministratorsController@edit');
                    Route::post('{id}/edit', 'AdministratorsController@update');
                    Route::get('{id}/delete', 'AdministratorsController@destroy');
                    Route::post('create', 'AdministratorsController@store');
                    Route::get('create', 'AdministratorsController@create');
                });

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
        });

    });

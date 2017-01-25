<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['uses' => 'HomeController@index']);

Route::get('/login',['uses' => 'AuthController@login']);

Route::post('/login',['uses' => 'AuthController@auth']);

Route::get('/logout',['uses' => 'AuthController@logout']);

Route::get('/dashboard/overview', ['uses' => 'DashboardController@overview']);

Route::get('/dashboard/clients', ['uses' => 'DashboardController@clients']);

Route::get('/dashboard/clients/{id}', ['uses' => 'DashboardController@clientinfo']);;

Route::get('/dashboard/addclient', ['uses' => 'DashboardController@addClient']);

Route::post('/clients/add', ['uses' => 'ClientController@addClient']);

Route::get('/getCsrf', function () {
    return csrf_token();
});

Route::post('/postPerformance',['uses' => 'DashboardController@postCompanyPerformance']);

Route::post('/postLogFile',['uses' => 'DashboardController@postLogFile']);
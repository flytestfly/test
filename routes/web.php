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

Route::get('/', 'HomeController@index')->name('main');
Route::get('/test/{slug}', 'HomeController@show')->name('test.blog');
Route::get('/event/{slug}', 'HomeController@event')->name('event.blog');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
	Route::get('/', 'DashboardController@index')->name('main.admin');
	Route::resource('/events', 'EventsController');
	Route::resource('/users', 'UsersController');
	Route::resource('/tests', 'TestsController');
});

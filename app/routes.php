<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@showWelcome']);
Route::get('user', ['as' => 'user', 'uses' => 'UserController@hello']);
Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@master']);
Route::get('test', ['as' => 'home', 'uses' => 'AdminController@abcd']);
Route::get('admin/update', ['as' => 'adminupdate', 'uses' => 'AdminController@update']);
Route::get('admin/lostbook', ['as' => 'adminlostbook', 'uses' => 'AdminController@lost']);

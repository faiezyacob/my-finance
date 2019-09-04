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
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::put('profile/salary', ['as' => 'profile.salary', 'uses' => 'ProfileController@salary']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('finance/create', ['as' => 'finance.create', 'uses' => 'FinanceController@create']);
	Route::get('finance', ['as' => 'finance.index', 'uses' => 'FinanceController@index']);
	Route::get('finance/{id}/', ['as' => 'finance.edit', 'uses' => 'FinanceController@edit']);
	Route::get('finance/delete/{id}', ['as' => 'finance.delete', 'uses' => 'FinanceController@destroy']);
	Route::put('finance/update/{id}', ['as' => 'finance.update', 'uses' => 'FinanceController@update']);
	Route::post('finance/store', ['as' => 'finance.store', 'uses' => 'FinanceController@store']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('goal/create', ['as' => 'goal.create', 'uses' => 'GoalController@create']);
	Route::get('goal', ['as' => 'goal.index', 'uses' => 'GoalController@index']);
	Route::get('goal/{id}', ['as' => 'goal.edit', 'uses' => 'GoalController@edit']);
	Route::put('goal/update/{id}', ['as' => 'goal.update', 'uses' => 'GoalController@update']);
	Route::post('goal/store', ['as' => 'goal.store', 'uses' => 'GoalController@store']);
	Route::get('goal/delete/{id}', ['as' => 'goal.delete', 'uses' => 'GoalController@destroy']);
});
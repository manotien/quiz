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

Route::get('/', 'WelcomeController@index');

Route::get('/index','IndexController@index');
Route::get('home', 'HomeController@index');
Route::get('index/{id}','IndexController@showfirst');
Route::get('indexgo','IndexController@shownext');

Route::group(['middleware'=>'auth'],function(){
	Route::get('create','CreateController@index');
	Route::get('create/quiz','QuizController@index');
	Route::post('create','QuizController@store');
	Route::get('create/{id}','QuizController@show');
	Route::get('delete/{id}','QuizController@delete');
	Route::get('goedit/{id}','QuizController@goedit');
	Route::get('edit/{id}','QuizController@edit');


	Route::post('create/{id}','QuestionController@store');
	Route::get('create/{id}/question','QuestionController@index');
	Route::get('create/{id}/{id2}','QuestionController@show');
	Route::get('delete/{id}/{id2}','QuestionController@delete');
	Route::get('goedit/{id}/{id2}','QuestionController@goedit');
	Route::get('edit/{id}/{id2}','QuestionController@edit');

	Route::get('create/{id}/{id2}/choice','ChoiceController@index');
	Route::post('create/{id}/{id2}','ChoiceController@store');
	Route::get('delete/{id}/{id2}/{id3}','ChoiceController@delete');
	Route::get('goedit/{id}/{id2}/{id3}','ChoiceController@goedit');
	Route::get('edit/{id}/{id2}/{id3}','ChoiceController@edit');
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

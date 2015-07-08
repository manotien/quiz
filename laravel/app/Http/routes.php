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


Route::get('/gettopic','IndexController@getTopic');
Route::get('/getpic','IndexController@getpic');

Route::get('/getquiz','IndexController@index');

Route::get('/getquestion/{id}','QuizController@showfirst');

Route::get('getchoice/{id}','EditController@getchoice');
Route::get('home', 'HomeController@index');

Route::group(['middleware'=>'auth'],function(){


	Route::get('/auth/getpic_quiz','IndexController@getpic_quiz');

	Route::post('addquiz','AddController@addquiz');
	Route::post('addquestion/{id}','AddController@addquestion');
	Route::post('addchoice/{id}/{id2}','AddController@addchoice');

	Route::get('deltopic/{id}','DeleteController@topic');
	Route::get('delquestion/{id}/{id2}','DeleteController@question');
	Route::get('delchoice/{id}/{id2}/{id3}','DeleteController@choice');

	Route::post('edittopic/{id}','EditController@topic');
	Route::post('editquestion/{id}/{id2}','EditController@question');
	Route::post('editchoice/{id}/{id2}/{id3}','EditController@choice');

});

//Route::group(['middleware'=>'auth'],function(){
	Route::get('create','CreateController@index');
	Route::get('create/quiz','QuizController@index');
	Route::post('create','QuizController@store');
	Route::get('create/{id}','QuizController@show');
	Route::get('delete/{id}','QuizController@delete');
	Route::get('goedit/{id}','QuizController@goedit');
	Route::post('edit/{id}','QuizController@edit');

	Route::post('create/{id}','QuestionController@store');
	Route::get('create/{id}/question','QuestionController@index');
	Route::get('create/{id}/{id2}','QuestionController@show');
	Route::get('delete/{id}/{id2}','QuestionController@delete');
	Route::get('goedit/{id}/{id2}','QuestionController@goedit');
	Route::post('edit/{id}/{id2}','QuestionController@edit');

	Route::get('create/{id}/{id2}/choice','ChoiceController@index');
	Route::post('create/{id}/{id2}','ChoiceController@store');
	Route::get('delete/{id}/{id2}/{id3}','ChoiceController@delete');
	Route::get('goedit/{id}/{id2}/{id3}','ChoiceController@goedit');
	Route::post('edit/{id}/{id2}/{id3}','ChoiceController@edit');
//});
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('{any}', 'WelcomeController@index')->where('any', '.*');


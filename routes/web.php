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

Route::get('/', function() {
    return view('home');
});

Route::get('/quiz/{quiz}', 'QuizController@show')->where('file', '[a-zA-Z0-9\_\-]');

Route::get('/submissions', 'SubmissionController@index');
Route::get('/submission/{submissionId}', 'SubmissionController@showById');
Route::post('/submission', 'SubmissionController@save');
Route::post('/submission/view', 'SubmissionController@show');

Route::get('/submission/grade/{submissionId}', 'SubmissionController@showForGrading');
Route::post('/submission/grade/{submissionId}', 'SubmissionController@grade');


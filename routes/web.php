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


Route::group(['middleware' => 'auth'],function(){

    Route::post('/create','NoteController@store');
    Route::get('/notes','NoteController@getData');
    Route::delete('/delete','NoteController@deleteNote');
    Route::patch('/update','NoteController@updateNote');

    Route::post('master/create','ShumokuController@store');
    Route::get('/masters','ShumokuController@getData');
    Route::delete('/master','ShumokuController@deleteMaster');
 
    Route::get('/top', function () {
        return view('app/index');
    });
    Route::get('/master', function () {
        return view('app/master');
    });

    
});
    


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/login/twitter', 'Auth\TwitterController@redirectToProvider')->name("twitter.login");
Route::get('/login/twitter/callback', 'Auth\TwitterController@handleProviderCallback'); 
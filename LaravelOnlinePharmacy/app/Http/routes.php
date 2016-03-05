<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('drugs', 'DrugsController');

Route::resource('comments', 'CommentsController');

Route::resource('nestedComments', 'NestedCommentsController');

Route::post('drugs/{drugs}/like', 'DrugsController@submitLike');

Route::post('drugs/{drugs}/dislike', 'DrugsController@submitDislike');

Route::post('drugs/{drugs}/comment', 'DrugsController@postComment');

Route::post('drugs/myNested', 'DrugsController@postNestedComment');

Route::get('drugs/price/{id}', 'DrugsController@drugPrice');

//Tuka
Route::get('alldrugs',  'DrugsController@listAllDrugsFromUser');



//Route::get('drugs/{drugs}/comment/{coment}/nested', 'DrugsController@postNestedComment');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::resource('drugs', 'DrugsController');

    Route::resource('comments', 'CommentsController');

    Route::post('drugs/{drugs}/like', 'DrugsController@submitLike');

    Route::post('drugs/{drugs}/dislike', 'DrugsController@submitDislike');

    Route::post('drugs/{drugs}/comment', 'DrugsController@postComment');

    Route::post('drugs/myNested', 'DrugsController@postNestedComment');
    
    Route::get('drugs/price/{id}', 'DrugsController@drugPrice');

    //Tuka
    Route::get('alldrugs',  'DrugsController@listAllDrugsFromUser');

    Route::get('/home', 'HomeController@index');


    //Route::get('drugs/{drugs}/comment/{coment}/nested', 'DrugsController@postNestedComment');
});

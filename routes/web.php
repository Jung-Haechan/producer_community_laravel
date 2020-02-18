<?php




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('post', 'PostsController');

Route::resource('reply', 'RepliesController')->only(['store', 'destroy']);
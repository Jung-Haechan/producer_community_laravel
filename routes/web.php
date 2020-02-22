<?php




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('post', 'PostsController');

Route::resource('reply', 'RepliesController')->only(['store', 'destroy']);

Route::put('mail/group_update', 'MailsController@group_update')->name('mail.group_update');
Route::resource('mail', 'MailsController')->except(['edit', 'destroy']);

Route::get('storage/{board}/{file_name}', 'FilesController@show');

Route::get('/mypage', 'HomeController@mypage')->name('mypage');

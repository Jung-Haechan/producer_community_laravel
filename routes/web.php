<?php




Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('like/{post}', 'LikesController@show');
Route::post('like/{post}', 'LikesController@like');

Route::post('post/search', 'PostsController@search')->name('post.search');
Route::resource('post', 'PostsController');

Route::resource('reply', 'RepliesController')->only(['store', 'destroy']);

Route::put('mail/group_update', 'MailsController@group_update')->name('mail.group_update');
Route::resource('mail', 'MailsController')->except(['edit', 'destroy']);

Route::get('mypage', 'HomeController@mypage')->name('mypage');

Route::get('best', 'BestController@index')->name('best.index');

Route::get('introduce', 'HomeController@introduce')->name('introduce');

Route::resource('hof', 'HofController')->only(['index', 'store', 'destroy']);

Route::resource('qna', 'QnaController')->except(['edit']);

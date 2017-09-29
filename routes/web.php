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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleProviderCallback');

Route::group(['middleware' => 'auth'], function () {
    // Articles
    Route::get('post/create', [
        'as' => 'post.create', 'uses' => 'PostController@create'
    ]);
    Route::post('post/create', [
        'as' => 'post.store', 'uses' => 'PostController@store'
    ]);
    Route::get('post/edit/{id}', [
        'as' => 'post.edit', 'uses' => 'PostController@edit'
    ]);
    Route::patch('post/edit/{id}', [
        'as' => 'post.update', 'uses' => 'PostController@update'
    ]);
    Route::post('post/delete', [
        'as' => 'post.delete', 'uses' => 'PostController@delete'
    ]);
    Route::get('post/lists', [
        'as' => 'post.lists', 'uses' => 'PostController@index'
    ]);
});

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

Auth::routes();

Route::get('/', 'PostController@index');
Route::get('/home', 'PostController@index')->name('home');
Route::get('/post', 'PostController@post');
Route::get('/show', 'PostController@show')->name('show');
Route::post('/create_post', 'PostController@create');
Route::post('/delete_post', 'PostController@delete');

Route::get('/update_post', 'PostController@update');
Route::post('/update_post', 'PostController@update');


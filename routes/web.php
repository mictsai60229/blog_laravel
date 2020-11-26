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

// BlogController
Route::get('/', 'BlogController@index');
Route::get('/home', 'BlogController@index')->name('home');
Route::get('/post', 'BlogController@post');
Route::get('/show', 'BlogController@show')->name('show');
Route::post('/create_blog', 'BlogController@create');
Route::post('/delete_blog', 'BlogController@delete');
Route::get('/update_blog', 'BlogController@update_index');
Route::post('/update_blog', 'BlogController@update');





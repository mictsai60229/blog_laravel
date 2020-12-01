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
Route::post('/create_blog', 'BlogController@create_or_update');
Route::post('/update_blog', 'BlogController@create_or_update');
Route::post('/delete_blog', 'BlogController@delete');



//BlogResponseController
Route::post('/create_blog_response', 'BlogResponseController@create');
Route::post('/delete_blog_response', 'BlogResponseController@delete');





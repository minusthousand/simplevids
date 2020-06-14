<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    $home = '/home';
    return redirect($home);
});

Auth::routes();

Route::get('/home', 'VideoController@index')->name('home');

Route::get('/videos/{id?}/preview', 'VideoController@preview')->name('preview');

Route::get('/videos/{id?}/video', 'VideoController@video')->name('video');

Route::get('/videos/{id?}/videoview', 'VideoController@videoView')->name('videoView');

Route::get('/{id?}/myvideos', 'VideoController@myVideos')->name('myVideos');

Route::get('/upload', 'VideoController@upload')->name('upload');

Route::post('/upload', 'VideoController@store')->name('storeVideo');

Route::post('/video/{id?}/comment', 'CommentController@store')->name('storeComment');

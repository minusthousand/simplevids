<?php

use App\Http\Controllers\PlaylistVideoController;
use App\Http\Controllers\VideoController;
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

Route::get('/videos/{id?}/addtoplaylist', 'PlaylistController@selection');

Route::get('/newplaylist', 'PlaylistController@create');

Route::post('/newplaylist', 'PlaylistController@store')->name('storePlaylist');

Route::get('/videos/{id?}/delete', 'VideoController@delete');

Route::get('/videos/{id?}/report', 'ReportController@create');

Route::post('/report', 'ReportController@store')->name('storeReport');

Route::get('/{id?}/myvideos', 'VideoController@myVideos')->name('myVideos');

Route::get('/upload', 'VideoController@upload')->name('upload');

Route::post('/upload', 'VideoController@store')->name('storeVideo');

Route::post('/video/{id?}/comment', 'CommentController@store')->name('storeComment');

Route::get('/{id?}/myplaylists', 'PlaylistController@myPlaylists')->name('myPlaylists');

Route::get('/createliked', 'PlaylistController@createLiked');

Route::get('/playlist/{id?}', 'PlaylistVideoController@show');

Route::post('/playlist/{id?}', 'PlaylistVideoController@add');

Route::get('/playlist/{id?}/delete', 'PlaylistController@delete');

Route::post('/playlist/{id?}/check', 'PlaylistVideoController@check');

Route::post('/getId', 'PlaylistController@getId');

Route::post('/video/{id?}/likes', 'VideoController@like');

Route::post('/video/{id?}/getlikes', 'VideoController@getlikes');

Route::get('/{id?}/likedvideos', 'PlaylistVideoController@likedVideos');

Route::get('lang/{locale}','LanguageController');

Route::get('video/{video_id?}/comment/{id?}/delete', 'CommentController@delete');

Route::get('videos/{id?}/edit', 'VideoController@edit');

Route::post('videos/{id?}/edit', 'VideoController@update');

Route::get('videosall', 'VideoController@showAll')->name('VideosAll');

Route::get('playlistsall', 'PlaylistController@showAll')->name('PlaylistsAll');

Route::get('reportsall', 'ReportController@showAll')->name('ReportsAll');

Route::get('/report/{id?}/delete', 'ReportController@delete');

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

// User 認証不要
Route::get('/', function () { return redirect('/home'); });

// User ログイン後
Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/search', 'User\SendController@getsearch');
    Route::post('/search', 'User\SendController@sendnotify');
    Route::get('/profile/edit', 'User\ProfileController@edit');
    Route::post('/profile/edit', 'User\ProfileController@update');
});

// Admin 認証不要
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/login'); });
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login')->name('admin.login');
});

// Admin ログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::post('/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
    Route::post('/home', 'Admin\HomeController@index')->name('admin.home');
    Route::get('/index', 'Admin\AdminHomeController@index');
    Route::get('/delete', 'Admin\AdminHomeController@delete');
});

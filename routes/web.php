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

Route::get('/', 'V1\Web\backend\UserController@index');

Route::get('login', 'V1\Web\backend\UserController@login')->name('login');
Route::post('login', 'V1\Web\backend\UserController@loginAttempt')->name('login_attempt');
Route::get('/home', [
    'as' => 'trangchu',
    'uses' => 'V1\Web\PageController@getIndex',
]);
Route::prefix('admin')->group(function (){
    Route::get('/', 'V1\Web\backend\UserController@index')->name('admin.index');
    Route::resource('user', 'V1\Web\backend\UserController');
});
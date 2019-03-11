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

Route::get('/', function () {
    return view('backend.create_admin');
});

Route::get('login', 'V1\Web\backend\UserController@login')->name('login');
Route::post('login', 'V1\Web\backend\UserController@loginAttempt')->name('login_attempt');

Route::group(['prefix' => 'admin', 'namespace' => 'V1\Web\backend'], function () {
    Route::resource('user', 'UserController')->except('show');
    Route::resource('employee', 'V1\Web\backend\AdminController');

    Route::group(['prefix' => 'user'], function () {
        Route::put('/{user}/password', 'UserController@updatePassword')->name('user.update_password');
        Route::get('/search', 'UserController@searchCustomer')->name('user.search_customer');
    });
});

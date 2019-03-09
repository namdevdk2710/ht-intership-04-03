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

Route::prefix('admin')->group(function () {
    Route::resource('user', 'V1\Web\backend\UserController')->except('show');
    Route::resource('employee', 'V1\Web\backend\AdminController');
    Route::prefix('user')->group(function () {
        Route::put('/{user}/password', 'V1\Web\backend\UserController@updatePassword')->name('user.update_password');
        Route::get('/search', 'V1\Web\backend\UserController@searchCustomer')->name('user.search_customer');
    });
});

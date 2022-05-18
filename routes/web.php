<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great
|
*/

/* ---- pagesController ---- */

//dashboard view
Route::get('/','pagesController@dashboard')->name('pages.dashboard');
//signup view

Route::get('signup/','pagesController@signup')->name('pages.signup');
//login view

Route::get('login/','pagesController@login')->name('pages.login');

//forgot password view
Route::get('forgot-password/','pagesController@forgot_password')->name('pages.forgot_password');
/* ----------------------- */

/* ---- authController ---- */
// addUser
Route::post('signup/','authController@addUser')->name('auth.addUser');

// log in
Route::post('login/','authController@login')->name('auth.login');

// Log Out
Route::post('logout/','authController@logout')->name('auth.logout');

// forgot-password
Route::post('forgot-password/','authController@forgot_password')->name('auth.forgot_password');



// login From Email
Route::get('loginFromEmail/','authController@lfemail_action')->name('loginFromEmail');
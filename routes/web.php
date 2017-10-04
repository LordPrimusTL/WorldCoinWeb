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


//Utility
Route::get('/','UtilityController@Home')->name('home');
Route::get('/about','UtilityController@About')->name('about');
Route::get('/contact','UtilityController@Contact')->name('contact');



//Account
Route::get('/register','AccountController@Register')->name('register');
Route::post('/register','AccountController@RegisterPost')->name('register_post');
Route::get('/login','AccountController@Login')->name('login');
Route::post('/login','AccountController@LoginPost')->name('login_post');


Route::group(['prefix' => '/user/','middleware' => ['auth','AuthUserCheck','UserActivated']], function ()
{
    Route::get('dashboard','UserController@Dashboard');
});


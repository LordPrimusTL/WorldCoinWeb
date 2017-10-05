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
Route::get('/register/referral/{r_link}','AccountController@RegisterRef')->name('register_referrals');
Route::post('/register','AccountController@RegisterPost')->name('register_post');
Route::get('/login','AccountController@Login')->name('login');
Route::post('/login','AccountController@LoginPost')->name('login_post');
Route::get('/logout','AccountController@Logout')->name('logout');


Route::group(['prefix' => '/user/','middleware' => ['auth','AuthUserCheck','UserActivated']], function ()
{
    Route::get('dashboard','UserController@Dashboard')->name('user_dashboard');
    Route::get('profile','UserController@Profile')->name('user_profile');
    Route::get('accounts','UserController@Account')->name('user_account');
    Route::get('invest','UserController@Invest')->name('user_invest');
    Route::get('withdrawals','UserController@Withdrawals')->name('user_withdrawals');
    Route::get('transactions','UserController@Transactions')->name('user_transaction');
    Route::get('referrals','UserController@Referrals')->name('user_referrals');
    Route::get('support','UserController@Support')->name('user_support');
});



Route::group(['prefix' => '/admin/',['middleware' => ['auth','AdminAuthCheck']]],function ()
{
    Route::get('dashboard','AdminController@Dashboard')->name('admin_dashboard');
    Route::get('user/view/{id}','Admincontroller@UserView')->name('admin_user_view');




    Route::post('user/profile/edit/{id}','AdminController@UserEdit')->name('admin_user_edit');
});


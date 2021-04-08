<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


// auth 
Auth::routes();

//testing 
Route::get('/home', 'HomeController@index')->name('home')->middleware('verifiedphone'); 
Route::get('/testverif', function (){ return 'verified';})->middleware('verifiedphone'); 


//phone verification
Route::get('phone/verify', 'PhoneVerificationController@show')->name('phoneverification.notice');
Route::post('phone/verify', 'PhoneVerificationController@verify')->name('phoneverification.verify');


//admin  auth
Route::get('admin/login', 'Admin\AdminAuthController@showAdminLoginForm')->name('showAdminLoginForm');
Route::post('admin/login', 'Admin\AdminAuthController@adminLogin')->name('admin.login');

//admin panel

//users

Route::get('/admin/users', 'Admin\UserController@index')->name('users.list');
Route::get('/admin/users/create', 'Admin\UserController@create')->name('users.create');
Route::post('/admin/users/create', 'Admin\UserController@store')->name('users.store');
Route::get('/admin/users/{id}', 'Admin\UserController@show')->name('users.show');
Route::get('/admin/users/edit/{id}', 'Admin\UserController@edit')->name('users.edit');
Route::put('/admin/users/edit/{id}', 'Admin\UserController@update')->name('users.update');
Route::get('/admin/users/delete/{id}', 'Admin\UserController@delete')->name('users.delete');



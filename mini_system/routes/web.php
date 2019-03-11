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
    return view('welcome');
});


route::get('admin/login', "AdminController@login")->name('adminLogin');
route::post('admin/login', "AdminController@loginAuth")->name('adminAuth');

Route::group(['prefix' => 'admin', 'middleware' => 'userAuth'], function(){
  route::get('/', "AdminController@dashboard");
  Route::resource('groups', 'GroupsController');
  Route::resource('admins', 'AdminController');
  Route::resource('settings', 'SettingsController');
  Route::get('error_logs', 'ErrorLogsReprot@index');
  Route::post('delete_logs', 'ErrorLogsReprot@delete');
  Route::get('profile', 'ProfileController@edit');
  Route::put('profile/{id}', 'ProfileController@update');
});

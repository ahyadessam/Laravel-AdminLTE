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

Route::group(['middleware' => 'userAuth'], function(){
  route::get('admin', "AdminController@dashboard");
  Route::resource('admin/groups', 'GroupsController');
  Route::resource('admin/admins', 'AdminController');
});

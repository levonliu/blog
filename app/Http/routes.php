<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test','IndexController@index');


//登录界面
Route::any('admin/login','Admin\LoginController@login');

//生成验证码
Route::get('admin/code','Admin\LoginController@code');

//密码加密
Route::any('admin/crypt','Admin\LoginController@crypt');

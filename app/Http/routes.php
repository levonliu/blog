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


//Route::get('/test','IndexController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin',], function (){
    //登录界面
    Route::any('login','LoginController@login');

    //生成验证码
    Route::get('code','LoginController@code');

    //密码加密
    Route::any('crypt','LoginController@crypt');
});


//后台
Route::group(['middleware' => ['admin.login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function (){
    //主界面index
    Route::get('index','IndexController@index');
    //info
    Route::get('info','IndexController@info');
    //退出quit
    Route::get('quit','LoginController@quit');
    //修改密码pwd
    Route::any('pwd','IndexController@pwd');

    Route::resource('category','CategoryController');
});

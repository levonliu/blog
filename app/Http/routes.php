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

//Route::get('/', function () {
//    return view('welcome');
//});

//前台
Route::group(['namespace' => 'Home'], function (){
    Route::get('/','IndexController@index');
    Route::get('/cate','IndexController@cate');
    Route::get('/art','IndexController@article');
});



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
    //图片上传
    Route::any('upload','CommonController@upload');

    //分类排序changeorder
    Route::post('cate/changeorder','CategoryController@changeorder');
    //分类资源路由
    Route::resource('category','CategoryController');

    //文章资源路由
    Route::resource('article','ArticleController');

    //友情链接资源路由
    Route::resource('links','LinksController');
    Route::post('links/changeorder','LinksController@changeorder');

    //导航资源路由
    Route::resource('navs','NavsController');
    Route::post('navs/changeorder','NavsController@changeorder');

    //配置项资源路由
    Route::get('conf/putfile','ConfigController@putFile');
    Route::resource('conf','ConfigController');
    Route::post('conf/changeorder','ConfigController@changeorder');
    Route::post('conf/changecontent','ConfigController@changecontent');
});

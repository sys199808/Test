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

//后台登录页面
Route::get('admin/login','Admin\LoginController@login');

//验证码
Route::get('admin/yzm','Admin\LoginController@yzm');
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');

//表单验证 业务逻辑
Route::post('admin/login','Admin\LoginController@dologin');
//加密、测试扩展
Route::get('admin/crypt','Admin\LoginController@crypt');

//后台路由组 prefix-url前缀  namespace命名空间 middleware中间件
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'login.admin'],
    function(){
    //后天登录首页 业务逻辑
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
//  退出后台
    Route::get('quit','IndexController@quit');
//  修改密码
    Route::get('pass','IndexController@pass');
//  修改密码业务逻辑
    Route::post('pass','IndexController@dopass');

//  用户模块
    Route::resource('user','UserController');
//  上传头像的逻辑处理
    Route::post('upload','UserController@picUpload');
    Route::put('upload','UserController@picUpload');
});


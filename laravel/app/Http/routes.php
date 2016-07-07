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
//网站首页
Route::get('/', function () {
    return view('welcome');
});

//后台首页  用户首页
Route::get("/Admin","Admin\indexController@index");
//登录首页
Route::get("/Admin/login","Admin\loginController@index");
//登录验证码
Route::get("/Admin/login/Captcha/{tmp}","Admin\loginController@captcha");
//后台的登录验证路由
Route::post("/Admin/login/logTodo","Admin\loginController@logTodo");
//退出登录的路由
Route::get("/Admin/login/logout","Admin\loginController@logOut");
//头像上传处理路由
Route::post("/Admin/user/avartar","Admin\userController@avartar");
//用户模块  创建一个资源路由   修改也使用的资源路由
Route::resource("/Admin/user","Admin\userController");
//后台进行搜索路由
Route::match(["get","post"],"/Admin/user","Admin\userController@index");
//增加用户的路由
Route::post("/Admin/user/store","Admin\userController@store");
//删除的路由
Route::get("/Admin/user/delete/{id}","Admin\userController@destroy");
//重定向路由
Route::get("/tips",function(){
    return view("/errors/tips");
});


//ajax请求修改用户分组的路由规则  增加用户路由 删除路由同上
Route::post("/Admin/user/setGroup","Admin\userController@setGroup");

//分组模块的处理
Route::resource("/Admin/group","Admin\groupController");

        
    
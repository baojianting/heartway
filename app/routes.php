<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return "hello";
	// return View::make('hello');
});

// 是否存在该手机号的请求
Route::post("register/isRegistered", "IsRegisteredController@isRegistered");

// 注册账号信息
Route::post("register/register", "RegisterController@register");
// Route::get("register/register", "RegisterController@register");

// 登录账号
Route::post("login", "LoginController@login");
// Route::get("login", "LoginController@login");

// 删除用户
Route::post("delete/user", "DeleteUserController@deleteUser");
// Route::get("delete/user", "DeleteUserController@deleteUser");


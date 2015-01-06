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

// 简单登录
Route::post("singlelogin", "SingleLoginController@singleLogin");
// Route::get("singlelogin", "SingleLoginController@singleLogin");
// 删除用户
Route::post("delete/user", "DeleteUserController@deleteUser");
// Route::get("delete/user", "DeleteUserController@deleteUser");

// 获取用户信息列表
Route::post("users/info", "GetUsersInfoController@getUsersInfo");
// Route::get("users/info", "GetUsersInfoController@getUsersInfo");

// 查找好友信息
Route::post("user/find", "FindUserController@findUser");
// Route::get("user/find", "FindUserController@findUser");

// 添加好友
Route::post("user/add", "AddUserController@addUser");
// Route::get("user/add", "AddUserController@addUser");

// 删除好友
Route::post("user/deleteFriend", "DeleteFriendShipController@deleteFriendShip");
// Route::get("user/deleteFriend", "DeleteFriendShipController@deleteFriendShip");

// 通过我的username来获取好友列表
Route::post("user/getMyFriend", "GetMyFriendsController@getMyFriends");
// Route::get("user/getMyFriend", "GetMyFriendsController@getMyFriends");

// 更改用户信息
Route::post("user/modify", "ModifyUserController@modUser");
Route::get("user/modify", "ModifyUserController@modUser");


// 获取排行榜分类
Route::post("rankinglist/routeArea", "RankinglistController@getRouteArea");
Route::get("rankinglist/routeArea", "RankinglistController@getRouteArea");

// 获取某一个地区的路线
Route::post("rankinglist/routeOfArea", "RankinglistController@routeOfArea");
Route::get("rankinglist/routeOfArea", "RankinglistController@routeOfArea");


// 获取某一个路线的排行榜
Route::post("rankinglist/getRankinglistOfRoute", "RankinglistController@getRankinglistOfRoute");
Route::get("rankinglist/getRankinglistOfRoute", "RankinglistController@getRankinglistOfRoute");

// 上传个人成绩
Route::post("rankinglist/upload", "RankinglistController@upload");
Route::get("rankinglist/upload", "RankinglistController@upload");


// 上传个人成绩
Route::post("rankinglist/uploadCustomInfo", "RankinglistController@uploadCustomInfo");
Route::get("rankinglist/uploadCustomInfo", "RankinglistController@uploadCustomInfo");

App::error(function(Exception $e)
{
    require_once __DIR__. "Utils/Constant.php";
    return Constant::$RETURN_FAIL;
});
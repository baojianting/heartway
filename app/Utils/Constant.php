<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/3
 * Time: 16:42
 */

/*
 *
 * 定义常量
 */
class Constant {

    /*
     * 请求的参数名称
     */
    static $PARAM_PHONE_NUM = "phone_number";
    static $PARAM_PWD = "password";


    /*
     * 返回的常量
     */
    static $RETURN_SUCCESS = "success";
    static $RETURN_FAIL = "fail";
    static $NO_DATA = "no_data";


    static $HAS_FRIEND = "already_friends";
    static $NOT_FRIEND = "not_friend";

    static $NO_FRIEND = "no_friend";

    // 一些数据库中的常量定义
    static $ROUTE_LOCK = 1;
    static $ROUTE_UNLOCK = 0;

} 
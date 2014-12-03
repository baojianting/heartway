<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/3
 * Time: 20:14
 */

require_once __DIR__. "../models/HwUser.php";
require_once __DIR__. "../Utils/Constant.php";
/*
 * 注册用户的处理器
 */
class Register extends BaseController {

    // 注册用户
    public function register() {
        // 获取手机号和密码
        $phoneNumber = $_POST[Constant::$PARAM_PHONE_NUM];
        $password = $_POST[Constant::$PARAM_PWD];

        if(isset($phoneNumber) && isset($password)) {
            $newUser = new HwUser();
            $newUser->phone_number = $phoneNumber;
            $newUser->create_time = date('y-M-d', time());
            $newUser->nick_name = $phoneNumber;
            $newUser->password = $password;
            $newUser->islock = 0;
            $newUser->gender = 0;
            // 新建数据
            $newUser->save();
            $id = $newUser->id;
            // 如果创建成功
            if(isset($id) && $id > 0) {
                return Constant::$RETURN_SUCCESS;
            }
            else {
                return Constant::$RETURN_FAIL;
            }
        } else {
            return Constant::$RETURN_FAIL;
        }
    }
} 
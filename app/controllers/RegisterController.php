<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/3
 * Time: 20:14
 */

require_once __DIR__. "/../Utils/Constant.php";
require_once __DIR__. "/../Utils/HeartwayUtils.php";
require_once __DIR__. "/../Utils/EmChatUtil.php";
/*
 * 注册用户的处理器
 */
class RegisterController extends BaseController {

    // 注册用户
    public function register() {

        if(!isset($_POST[Constant::$PARAM_PHONE_NUM]) || !isset($_POST[Constant::$PARAM_PWD])) {
            // print "1111111111<br/>";
            return Constant::$RETURN_FAIL;
        }

        // 获取手机号和密码
        $phoneNumber = $_POST[Constant::$PARAM_PHONE_NUM];
        $password = $_POST[Constant::$PARAM_PWD];

        if(!empty($phoneNumber) && !empty($password)) {

            // 对于手机号进行md5加密
            $phoneNumberMd5 = HeartwayUtils::md5($phoneNumber);
            // 开启事务
            DB::beginTransaction();
            $newUser = new HwUser();
            $newUser->phone_number = $phoneNumber;
            $newUser->create_time = date('Y-m-d', time());
            $newUser->nick_name = $phoneNumber;
            $newUser->password = $password;
            $newUser->islock = 0;
            $newUser->gender = 0;
            $newUser->avatar = 0;
            $newUser->signature = "";
            $newUser->sub_account = $phoneNumberMd5;

            // 新建数据
            $newUser->save();
            $id = $newUser->id;
            // print "id-------------->".$id;
            // 如果创建成功
            if(isset($id) && $id > 0) {
                // return Constant::$RETURN_SUCCESS;
                // 发送环信添加用户请求
                $emChatUtil = new EmChatUtil();
                $result = $emChatUtil->authorizeRegister($phoneNumberMd5, $password);
                // print_r($result);
                // 如果返回成功
                if(isset($result['entities'])) {
                    // print "2221111<br/>";
                    DB::commit();
                    return Constant::$RETURN_SUCCESS;
                } else {
                    // print "33311111<br/>";
                    DB::rollback();
                    return Constant::$RETURN_FAIL;
                }
            }
            else {
                // print "444411111<br/>";
                // 回滚
                DB::rollback();
                return Constant::$RETURN_FAIL;
            }
        } else {
            // print "55511111<br/>";
            return Constant::$RETURN_FAIL;
        }

    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/3
 * Time: 15:44
 */


class IsRegisteredController extends BaseController {

    // 获取是否存在该phone_number的值
    public function isRegistered() {
        include_once __DIR__."/../Utils/Constant.php";
        $phoneNumber = $_POST[Constant::$PARAM_PHONE_NUM];

        if(!isset($phoneNumber) || empty($phoneNumber)) {
            return Constant::$RETURN_FAIL;
        } else {
            $count = HwUser::whereRaw(Constant::$PARAM_PHONE_NUM." = ?", array($phoneNumber))->count();

            if(!empty($count)) {
                return Constant::$RETURN_SUCCESS;
            } else {
                return Constant::$RETURN_FAIL;
            }
        }
    }
} 
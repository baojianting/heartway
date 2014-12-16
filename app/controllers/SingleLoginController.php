<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/16
 * Time: 20:23
 */

require_once __DIR__."/../Utils/Constant.php";
class SingleLoginController extends BaseController {

    /*
     * 简单登录
     *
     *
     */
    public function singleLogin() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(!isset($_POST['username']) || !isset($_POST['password'])) {
                return Constant::$RETURN_FAIL;
            }

            $username = $_POST['username'];
            $pwd = $_POST['password'];

            $user = HwUser::whereRaw('sub_account = ? and password = ?', array($username, $pwd))->get();
            if(count($user) == 1) {
                return Constant::$RETURN_SUCCESS;
            }
            else {
                return Constant::$RETURN_FAIL;
            }

        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
            return Constant::$RETURN_FAIL;
        }
    }
} 
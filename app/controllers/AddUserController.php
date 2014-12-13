<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/13
 * Time: 23:53
 */

require_once __DIR__. "/../Utils/Constant.php";
class AddUserController extends BaseController {

    /*
     * 添加好友
     *
     */
    public function addUser() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!isset($_POST['phone_number'])) {
                return Constant::$RETURN_FAIL;
            }
            

        } else if($_SERVER['REQUEST_METHOD' == "GET"]) {
            return Constant::$RETURN_FAIL;
        }
    }
} 
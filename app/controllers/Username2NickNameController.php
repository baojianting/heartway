<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/15
 * Time: 21:08
 */

require_once __DIR__. "/../Utils/Constant.php";
class Username2NickNameController extends BaseController {


    /*
     * 将用户名转化成nickname
     *
     *
     *
     */
    public function exchange() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(!isset($_POST['username'])) {
                return Constant::$RETURN_FAIL;
            }

            $username = $_POST['username'];
            $users = HwUser::whereRaw('sub_account = ?', array($username))->get();
            if(count($users) != 1) {
                return Constant::$RETURN_FAIL;
            }

            return $users[0]->nick_name;

        }
        else if($_SERVER['REQUEST_METHOD'] == "GET") {
            return Constant::$RETURN_FAIL;
        }

    }
} 
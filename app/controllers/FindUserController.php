<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/13
 * Time: 23:38
 */

require_once __DIR__. "/../Utils/Constant.php";

class FindUserController extends BaseController {

    /*
     * 查找好友是否存在
     *
     */
    public function findUser() {

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(!isset($_POST['phone_number'])) {
                return Constant::$RETURN_FAIL;
            }

            $users = HwUser::whereRaw("phone_number = ?", array($_POST['phone_number']))->get();
            if(count($users) != 1) {
                return Constant::$RETURN_FAIL;
            } else {
                $userArr = array();
                $userArr['nick_name'] = $users[0]->nick_name;
                if(!isset($users[0]->signature)) {
                    $userArr['signature'] = "";
                }
                else {
                    $userArr['signature'] = $users[0]->signature;
                }
                $userArr['gender'] = $users[0]->gender;
                $userArr['avatar'] = $users[0]->avatar;
                $userArr['user_name'] = $users[0]->sub_account;

                return json_encode($userArr);

            }

        }
        // 如果是get请求，则返回fail
        else if($_SERVER["REQUEST_METHOD"] == "GET") {
            return Constant::$RETURN_FAIL;
        }

    }
} 
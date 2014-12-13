<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/13
 * Time: 21:28
 */

require_once __DIR__. "/../Utils/Constant.php";

class GetUsersInfoController extends BaseController {


    /*
     * 获取用户信息的列表
     * post进来的参数为json格式的字符串， 格式为：
     *  ("username1", "username2", ...);
     *
     * @return 如果失败，return fail
     * 如果成功： 返回json格式字符串：
     * {
     *      {
     *          ‘nick_name’: "----",
     *          ‘signature’: "----",
     *          ‘gender’: "----",
     *          ‘avatar’: "----",
     *          ‘sub_account’: "----",
     *      }
     *      {
     *          ‘nick_name’: "----",
     *          ‘signature’: "----",
     *          ‘gender’: "----",
     *          ‘avatar’: "----",
     *          ‘sub_account’: "----",
     *      }
     *      {
     *          ‘nick_name’: "----",
     *          ‘signature’: "----",
     *          ‘gender’: "----",
     *          ‘avatar’: "----",
     *          ‘sub_account’: "----",
     *      }
     * }
     */
    public function getUsersInfo() {

        // 如果是POST请求
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            // print("POST method");
            if(!isset($_POST['usernames'])) {
                return Constant::$RETURN_FAIL;
            }
            $reqStr = $_POST['usernames'];
            // print($reqStr);
            $reqArr = explode(",", $reqStr);
            // print_r($reqArr);
            // 如果数组为空，则返回fail
            if(empty($reqArr)) {
                return Constant::$RETURN_FAIL;
            }
            // 对于json传递过来的数组进行处理

            $sqlStr = "";
            foreach($reqArr as $subAccount) {
                $sqlStr = $sqlStr. "sub_account = '".trim($subAccount). "' or ";
            }
            $sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 4);
            // print("the sqlStr is: ". $sqlStr);

            $users = HwUser::whereRaw($sqlStr)->get();

            $returnArr = array();

            foreach ($users as $user) {

                $userArr = array();
                $userArr['nick_name'] = $user->nick_name;
                if(!isset($user->signature)) {
                    $userArr['signature'] = "";
                } else {
                    $userArr['signature'] = $user->signature;
                }
                $userArr['gender'] = $user->gender;
                $userArr['avatar'] = $user->avatar;
                $userArr['sub_account'] = $user->sub_account;
                array_push($returnArr, $userArr);
            }

            return json_encode($returnArr);


        }
        // 如果是GET请求
        else if($_SERVER['REQUEST_METHOD'] == "GET") {

            // 返回fail
            return Constant::$RETURN_FAIL;
        }
    }
} 
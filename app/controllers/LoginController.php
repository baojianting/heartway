<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/4
 * Time: 20:04
 */

require_once __DIR__."/../Utils/Constant.php";

class LoginController extends BaseController {

    /*
     * 用户发送登录信息的时候进行登录处理
     *
     */
    public function login() {

        $userName = $_POST[Constant::$PARAM_PHONE_NUM];
        $password = $_POST[Constant::$PARAM_PWD];
        // 如果账号密码不为空
        if(!empty($userName) && !empty($password)) {
            $users = HwUser::whereRaw('phone_number = ? and password = ?', array($userName, $password))->get();
            // 如果数据库中存在该信息
            if(count($users) == 1) {
                $myUserName = $users[0]->sub_account;
                $myNickName = $users[0]->nick_name;
                $myPassword = $users[0]->password;
                $myAvatar = $users[0]->avatar;
                $myGender = $users[0]->gender;
                $mySignature = $users[0]->signature;

                // 个人信息的数组
                $myInfoArr = array();
                $myInfoArr['user_name'] = $myUserName;
                $myInfoArr['nick_name'] = $myNickName;
                $myInfoArr['password'] = $myPassword;
                $myInfoArr['avatar'] = $myAvatar;
                $myInfoArr['gender'] = $myGender;
                $myInfoArr['signature'] = $mySignature;

                // 查找该用户的好友信息
                $friends = $users[0]->friends;
                print(count($friends));
                // 存放好友信息的数组
                $friendsArr = array();
                // 遍历好友的信息
                if(count($friends) > 0) {
                    foreach($friends as $friend) {
                        $friendArr = array();
                        $friendArr['nick_name'] = $friend->nick_name;
                        $friendArr['avatar'] = $friend->avatar;
                        $friendArr['gender'] = $friend->gender;
                        $friendArr['signature'] = $friend->signature;
                        $friendArr['user_name'] = $friend->sub_account;
                        array_push($friendsArr, $friendArr);
                    }
                }
                // 存储是否成功的数组
                // $statusArr = array('status'=>'success');
                $resultArr = array();
                // 构造最终返回的数组
                // array_push($resultArr, $statusArr);
                $resultArr['status'] = 'success';
                $resultArr['my_info'] = $myInfoArr;
                $resultArr['friends'] = $friendsArr;
                // array_push($resultArr, $myInfoArr);
                // array_push($resultArr, $friendsArr);

                return json_encode($resultArr);

            }
            // 如果查找不到该用户信息
            else {
                // $statusArr = array('status'=>'fail');
                $resultArr = array('status'=>'fail');
                return json_encode($resultArr);
            }

        }
        // 如果账号密码为空
        else {
            $resultArr = array('status'=>'fail');
            return json_encode($resultArr);
        }
    }
} 
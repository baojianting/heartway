<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/4
 * Time: 20:04
 */

require_once __DIR__."/../Utils/Constant.php";

class LoginController extends BaseController {


    private static $STATUS = 'status';
    // private static $DATA = 'data';
    // private static $SUCCESS_STATUS = 'success';
    private static $WRONG_PASSWORD_OR_USERNAME = 'password_username_error';
    private static $FAIL_STATUS = 'fail';
    /*
     * 用户发送登录信息的时候进行登录处理
     *
     */
    public function login() {

        // 如果没有传递两个参数
        if(!isset($_POST[Constant::$PARAM_PHONE_NUM]) || !isset($_POST[Constant::$PARAM_PWD])) {
            $resultArr = array();
            $resultArr['status'] = self::$FAIL_STATUS;
            return json_encode($resultArr);
        }


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
                if(!isset($users[0]->signature) || empty($users[0]->signature)) {
                    $mySignature = "";
                } else {
                    $mySignature = $users[0]->signature;
                }

                // 个人信息的数组
                $dataArr = array();
                $dataArr['user_name'] = $myUserName;
                $dataArr['nick_name'] = $myNickName;
                $dataArr['password'] = $myPassword;
                $dataArr['avatar'] = $myAvatar;
                $dataArr['gender'] = $myGender;
                $dataArr['signature'] = $mySignature;

                // 查找该用户的好友信息
                $friends = $users[0]->friends;
                // print(count($friends));
                // 存放好友信息的数组
                $friendsArr = array();
                // 遍历好友的信息
                if(count($friends) > 0) {
                    foreach($friends as $friend) {
                        $friendArr = array();
                        $friendArr['nick_name'] = $friend->nick_name;
                        $friendArr['avatar'] = $friend->avatar;
                        $friendArr['gender'] = $friend->gender;
                        if(!isset($friend->signature) || empty($friend->signature)) {
                            $friendArr['signature'] = "";
                        } else {
                            $friendArr['signature'] = $friend->signature;
                        }

                        $friendArr['user_name'] = $friend->sub_account;
                        array_push($friendsArr, $friendArr);
                    }
                }
                $dataArr['friends'] = $friendsArr;

                // 查找该好友群组消息
                $groupsArr = array();
                $groups = $users[0]->hasGroups;
                // print($users[0]->id);
                foreach($groups as $group) {
                    $groupArr = array();
                    $groupArr['id'] = $group->id;
                    $groupArr['group_name'] = $group->group_name;
                    $groupArr['description'] = $group->description;
                    $groupArr['create_time'] = $group->create_time;
                    $groupArr['creator_id'] = $group->creator_id;
                    $groupArr['creator_nickname'] = $group->creator_nickname;
                    array_push($groupsArr, $groupArr);
                }

                $dataArr['groups'] = $groupsArr;

                // 存储是否成功的数组
                // $statusArr = array('status'=>'success');
                $resultArr = array();
                // 构造最终返回的数组
                $resultArr['status'] = 'success';
                $resultArr['data'] = $dataArr;

                return json_encode($resultArr);

            }
            // 如果查找不到该用户信息
            else {
                // $statusArr = array('status'=>'fail');
                $resultArr = array(self::$STATUS=>self::$WRONG_PASSWORD_OR_USERNAME);
                return json_encode($resultArr);
            }
        }
        // 如果账号密码为空
        else {
            $resultArr = array(self::$STATUS=>self::$FAIL_STATUS);
            return json_encode($resultArr);
        }
    }
} 
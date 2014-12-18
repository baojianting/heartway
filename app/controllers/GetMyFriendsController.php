<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/18
 * Time: 18:40
 */

require_once __DIR__."/../Utils/Constant.php";
class GetMyFriendsController extends BaseController {

    /*
     * 获取我的好友
     *
     */
    public function getMyFriends() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!isset($_POST['username'])) {
                return Constant::$RETURN_FAIL;
            }
            $myUsername = $_POST['username'];
            $me = HwUser::whereRaw('sub_account = ?', array($myUsername))->get();
            if(count($me) != 1) {
                return Constant::$RETURN_FAIL;
            }
            $myFriends = $me[0]->friends;
            if(count($myFriends) == 0) {
                return Constant::$NO_FRIEND;
            }
            $datasArr = array();
            foreach($myFriends as $friend) {
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
                array_push($datasArr, $friendArr);
            }
            return json_encode($datasArr);

        } else if($_SERVER['REQUEST_METHOD'] == "GET") {
            return Constant::$RETURN_FAIL;
        }
    }
} 
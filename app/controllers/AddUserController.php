<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/13
 * Time: 23:53
 */

require_once __DIR__. "/../Utils/Constant.php";
require_once __DIR__. "/../Utils/EmChatUtil.php";
class AddUserController extends BaseController {

    /*
     * 添加好友
     *
     */
    public function addUser() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!isset($_POST['my_username']) || !isset($_POST['your_username'])) {
                return Constant::$RETURN_FAIL;
            }

            $myPhoneNum = $_POST['my_username'];
            $yourPhoneNum = $_POST['your_username'];

            // 通过手机号来获取id号码
            $myInfo = HwUser::whereRaw('sub_account = ?', array($myPhoneNum))->get();
            $yourInfo = HwUser::whereRaw('sub_account = ?', array($yourPhoneNum))->get();
            if(count($myInfo) != 1 || count($yourInfo) != 1) {
                // echo("用户信息不存在");
                return Constant::$RETURN_FAIL;
            }
            $myId = $myInfo[0]->id;
            $yourId = $yourInfo[0]->id;

            // 获取环信方的账号
            $myAccount = $myInfo[0]->sub_account;
            $yourAccount = $yourInfo[0]->sub_account;

            // echo("myId: ".$myId. "; yourId: ".$yourId);
            DB::beginTransaction();
            try {
                DB::insert('insert into hw_friend_relationship(subject_user_id, friend_user_id) values(?, ?), (?, ?)',
                    array($myId, $yourId, $yourId, $myId));
            } catch(Exception $e) {
                DB::rollback();
                return Constant::$HAS_FRIEND;
            }


            // 给环信发送添加好友请求
            $emChatUtil = new EmChatUtil();
            $firstResultArr = $emChatUtil->addFriend($myAccount, $yourAccount);
            // print_r($firstResultArr);
            if(!isset($firstResultArr['entities'])) {
                DB::rollback();
                return Constant::$RETURN_FAIL;
            }
            $secondResultArr = $emChatUtil->addFriend($yourAccount, $myAccount);
            // print_r($secondResultArr);
            if(!isset($secondResultArr['entities'])) {
                DB::rollback();
                return Constant::$RETURN_FAIL;
            }

            // 返回成功，并且提交数据库
            DB::commit();
            return Constant::$RETURN_SUCCESS;

        } else if($_SERVER['REQUEST_METHOD'] == "GET") {
            return Constant::$RETURN_FAIL;
        }
    }
} 
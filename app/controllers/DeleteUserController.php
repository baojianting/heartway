<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/5
 * Time: 13:51
 */

require_once __DIR__."/../Utils/Constant.php";
require_once __DIR__."/../Utils/EmChatUtil.php";

class DeleteUserController extends BaseController {

    public function deleteUser() {
        // 删除用户
        if(isset($_POST['user_name'])) {
            $userName = $_POST['user_name'];
            $userNameMd5 = md5($userName);
            // print("md5------------->".$userNameMd5);
            // 开启事务
            DB::beginTransaction();
            // 这个地方以后需要修改(增加了好友和群组以后, 目前只做测试用).
            // DB::delete('delete from hw_friend_relationship where subject_user_id = ? or friend_user_id = ?',
            //                     array());
            $lineNum = DB::delete('delete from hw_user where phone_number = ?', array($userName));
            if($lineNum == 0) {
                DB::rollback();
                return 'no_user';
            }
            else if($lineNum > 1) {
                DB::rollback();
                return Constant::$RETURN_FAIL;
            }
            else if($lineNum == 1){
                $chatUtil = new EmChatUtil();
                // 发送删除请求
                $result =$chatUtil->deleteUser($userNameMd5);
                // print_r($result);
                if(isset($result['entities'])) {
                    DB::commit();
                    return Constant::$RETURN_SUCCESS;
                } else {
                    DB::rollback();
                    return Constant::$RETURN_FAIL;
                }
            }

        } else {
            return Constant::$RETURN_FAIL;
        }
    }
} 
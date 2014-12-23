<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/23
 * Time: 19:10
 */

require_once __DIR__."/../Utils/Constant.php";

class ModifyUserController extends BaseController {

    public function modUser() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            if(!isset($_POST['username'])) {
                return Constant::$RETURN_FAIL;
            }
            // 标记量，判断是否有参数传进来
            $hasNickname = true;
            $hasSignature = true;
            $hasPassword = true;
            $hasAvatar = true;
            $username = $_POST['username'];

            if(!isset($_GET['nickname'])) {
                $hasNickname = false;
            }
            if(!isset($_POST['signature'])) {
                $hasSignature = false;
            }
            if(!isset($_POST['password'])) {
                $hasPassword = false;
            }
            if(!isset($_POST['avatar'])) {
                $hasAvatar = false;
            }

            $updateSql = 'update hw_user set ';
            $paramArr = array();
            if($hasPassword) {
                $updateSql = $updateSql. 'password = ?,';
                array_push($paramArr, $_POST['password']);
            }
            if($hasAvatar) {
                $updateSql = $updateSql. 'avatar = ?,';
                array_push($paramArr, $_POST['avatar']);
            }
            if($hasSignature) {
                $updateSql = $updateSql. 'signature = ?,';
                array_push($paramArr, $_POST['signature']);
            }
            if($hasNickname) {
                $updateSql = $updateSql. 'nick_name = ?,';
                array_push($paramArr, $_POST['nickname']);
            }
            // 如果没有任何参数，则返回失败
            if(count($paramArr) == 0) {
                return Constant::$RETURN_FAIL;
            }
            $updateSql = substr($updateSql, 0, count($updateSql) - 2). ' where sub_account = ? ';
            array_push($paramArr, $username);
            // echo($updateSql);
            // print_r($paramArr);

            $affectRow = DB::update($updateSql, $paramArr);
            if($affectRow != 1) {
                return Constant::$RETURN_FAIL;
            } else {
                return Constant::$RETURN_SUCCESS;
            }


        } else if($_SERVER['REQUEST_METHOD'] == "GET") {
            return Constant::$RETURN_FAIL;
        }
    }
} 
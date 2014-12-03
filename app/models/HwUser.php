<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/3
 * Time: 15:31
 */


/*
 *  对应数据库里面的hw_user表
 *
 */
class HwUser extends Eloquent {

    // 关联表名
    protected $table = "hw_user";
    // 不设定数据库中的updated_at 和created_at字段
    public $timestamps = false;

    // 设定和自己的多对多关系(即好友表)
    public function friends() {
        return $this->belongsToMany("HwUser", "hw_friend_relationship", "subject_user_id", "friend_user_id");
    }

} 
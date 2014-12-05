<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/5
 * Time: 19:29
 */

class HwGroup extends Eloquent {

    // 关联表名
    protected $table = "hw_user";
    // 不设定数据库中的updated_at 和created_at字段
    public $timestamps = false;

    // 取出该群的所有成员
    public function groupMembers() {
        return $this->belongsToMany("HwUser", "hw_group_member", "hw_group_id", "hw_user_id");
    }
} 
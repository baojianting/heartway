<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2015/1/6
 * Time: 23:15
 */

class HwCustomRoute extends Eloquent {

    // 关联表名
    protected $table = "hw_custom_route";
    // 不设定数据库中的updated_at 和created_at字段
    public $timestamps = false;

} 
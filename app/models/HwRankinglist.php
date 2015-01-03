<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2015/1/3
 * Time: 15:44
 */

class HwRankinglist extends Eloquent {

    // 关联表名
    protected $table = "hw_rankinglist";
    // 不设定数据库中的updated_at 和created_at字段
    public $timestamps = false;

} 
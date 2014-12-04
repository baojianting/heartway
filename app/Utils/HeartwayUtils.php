<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/4
 * Time: 12:18
 */

class HeartwayUtils {

    /*
     * 将字符串通过md5加密并且返回
     * @param string $str: 原字符串
     * @return: 加密后的字符串
     *
     */
    public static function md5($str) {
        return md5($str);
    }
} 
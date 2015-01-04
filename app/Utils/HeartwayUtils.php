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

    public static function routePointsStrToArray($routePoints) {
        $pointsArr = array();
        $splitArr = explode("),", $routePoints);
        foreach($splitArr as $splitPiece) {
            if($splitPiece == "") {
                continue;
            }

            $pointArr = array();
            // str_replace(array("(", ")", ","), " ", $splitPiece);
            $sArr = explode(",", $splitPiece);
            if(count($sArr) != 2) {
                continue;
            }
            $lan = trim(str_replace(array("(", ")"), " ", $sArr[0]));
            if($lan != "") {
                // array_push($pointArr, $fixS);
                $pointArr["longitude"] = $lan;
            }

            $long = trim(str_replace(array("(", ")"), " ", $sArr[1]));
            if($long != "") {
                // array_push($pointArr, $fixS);
                $pointArr["latitude"] = $long;
            }
            // if(count($pointArr))
            array_push($pointsArr, $pointArr);
        }
        return $pointsArr;
    }

    public static function getTotalDistance($route_points) {

        return 0;
    }
}


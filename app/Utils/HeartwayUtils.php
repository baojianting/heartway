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

        $pointsArr = self::routePointsStrToArray($route_points);
        if(count($pointsArr) <= 1) {
            return 0;
        } else {

            $total = 0;
            for($i = 0; $i < count($pointsArr) - 1; $i++) {
                $total += self::getDistance($pointsArr[$i], $pointsArr[$i + 1]);
            }

            return $total;
        }

    }

    private static function getDistance($point1, $point2)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters

        $lat1 = ($point1["latitude"] * pi() ) / 180;
        $lng1 = ($point1["longitude"] * pi() ) / 180;

        $lat2 = ($point2["latitude"]  * pi() ) / 180;
        $lng2 = ($point2["longitude"] * pi() ) / 180;

        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance);
    }
}


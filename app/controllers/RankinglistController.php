<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2015/1/3
 * Time: 14:49
 */

require_once __DIR__. "/../Utils/Constant.php";
require_once __DIR__. "/../Utils/HeartwayUtils.php";

class RankinglistController extends BaseController {

    static $PAGE_NUM = 10;

    // 获取所有地区的分类
    public function getRouteArea() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $areas = HwRouteArea::all();
            if(!isset($areas) || count($areas) == 0) {
                return Constant::$RETURN_FAIL;
            }

            $retArr = array();
            foreach($areas as $area) {
                $arr = array();
                $arr["id"] = $area->id;
                $arr["name"] = $area->name;
                $arr["route_num"] = $area->route_num;
                $arr["picture"] = $area->picture;
                $arr["description"] = $area->detail;
                array_push($retArr, $arr);
            }

            return json_encode($retArr);

        } else {
            return Constant::$RETURN_FAIL;
        }
     }

    // 获取某个地区下的所有线路
    public function routeOfArea() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!isset($_POST["route_area_id"])) {
                return Constant::$RETURN_FAIL;
            }

            $routeAreaId = $_POST["route_area_id"];
            $routes = HwRoute::whereRaw('route_area_id = ? and is_lock = ?', array($routeAreaId, Constant::$ROUTE_UNLOCK))->get();
            if(!isset($routes)) {
                return Constant::$RETURN_FAIL;
            }
            if(count($routes) <= 0) {
                return Constant::$NO_DATA;
            } else {
                $retArr = array();
                foreach($routes as $route) {
                    $arr = array();
                    $arr["id"] = $route->id;
                    $arr["route_description"] = $route->route_description;
                    $arr["route_location"] = $route->route_location;
                    $arr["route_points"] = HeartwayUtils::routePointsStrToArray($route->route_points);
                    $arr["participate_number"] = $route->participate_number;
                    $arr["route_title"] = $route->route_title;
                    $arr["route_area_id"] = $route->route_area_id;
                    $arr["route_length"] = $route->route_length;
                    $arr["create_time"] = $route->create_time;
                    $arr["route_type"] = $route->route_type;
                    array_push($retArr, $arr);
                }
                return json_encode($retArr);
            }


        } else {
            return Constant::$RETURN_FAIL;
        }
    }

    // 获取某线路下的排行榜
    public function getRankinglistOfRoute() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!isset($_POST["route_id"])) {
                return Constant::$RETURN_FAIL;
            }

            $routeId = $_POST["route_id"];

            if(!isset($_POST["page_num"])) {
                $retSize = self::$PAGE_NUM;
            } else {
                $retSize = $_POST["page_num"];
            }

            $datas = DB::select("select total_time, total_distance, u.avatar, r.average_speed, r.route_points, u.id, u.nick_name from hw_user u, hw_rankinglist r where
                  r.hw_route_id = ? and hw_user_id = u.id order by average_speed desc limit ?, ?", array($routeId,
                  0, $retSize));
            if(!isset($datas)) {
                return Constant::$RETURN_FAIL;
            }
            if(count($datas) <= 0) {
                return Constant::$NO_DATA;
            } else {
                $retArr = array();
                foreach ($datas as $data) {
                    $arr = array();
                    $arr["id"] = $data->id;
                    $arr["nick_name"] = $data->nick_name;
                    $arr["average_speed"] = $data->average_speed;
                    $arr["route_points"] = HeartwayUtils::routePointsStrToArray($data->route_points);
                    $arr["avatar"] = $data->avatar;
                    $arr["total_time"] = $data->total_time;
                    $arr["total_distance"] = $data->total_distance;
                    array_push($retArr, $arr);
                }
                return json_encode($retArr);

            }

        } else {
            return Constant::$RETURN_FAIL;
        }
    }

    public function upload() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!isset($_POST["user_id"]) || !isset($_POST["route_id"]) || !isset($_POST["average_speed"])
                    || !isset($_POST["route_points"]) || !isset($_POST["total_time"])) {
                return Constant::$RETURN_FAIL;
            }

            $userId = $_POST["user_id"];
            $routeId = $_POST["route_id"];
            $averageSpeed = $_POST["average_speed"];
            $routePoints = $_POST["route_points"];
            $totalTime = $_POST["total_time"];

            try {
                $rankinglist = new HwRankinglist();
                $rankinglist->hw_user_id = $userId;
                $rankinglist->hw_route_id = $routeId;
                $rankinglist->average_speed = $averageSpeed;
                $rankinglist->route_points = $routePoints;
                $rankinglist->total_time = $totalTime;
                $rankinglist->total_distance = HeartwayUtils::getTotalDistance($routePoints);
                $rankinglist->save();

                return Constant::$RETURN_SUCCESS;
            } catch(Exception $e) {
                return Constant::$RETURN_FAIL;
            }




        } else {
            return Constant::$RETURN_FAIL;
        }
    }
}
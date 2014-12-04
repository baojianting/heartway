<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/4
 * Time: 14:16
 */


require_once __DIR__."/../Utils/EmChatUtil.php";

$util = new EmChatUtil();

$options = array();
$options['phone_number'] = 18792975133;
$url = "http://localhost:8001/heartway/public/index.php/register/isRegistered";
print($util->postCurl($url, $options));

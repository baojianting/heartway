<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/3
 * Time: 20:28
 */

/*
 * 环信服务端REST API
 *
 */
class EmChatUtil {

    static $TOKEN_FILE_PATH = "TokenInfo";

    private $clientId;
    private $clientSecret;
    private $orgName;
    private $appName;
    private $url;

    /*
     *
     *  初始化环信变量
     *  @param array $options: 参数数组
     */
    public function __construct($options) {
        $this->clientId = isset($options['client_id'])?$options['client_id']:'';
        $this->clientSecret = isset($options['client_secret'])?$options['client_secret']:'';
        $this->orgName = isset($options['org_name'])?$options['org_name']:'';
        $this->appName = isset($options['app_name'])?$options['app_name']:'';
        if(!empty($this->orgName) && !empty($this->appName)) {
            $this->url = "https://a1.easemob.com/".$this->orgName.'/'.$this->appName.'/';
        }
    }

    /*
     * curl发送http请求
     * @param string $url: 请求的url
     * @param array $options: 请求的数组参数
     * @param string $header: 请求头
     * @param string $type: 请求方法
     *
     */
    private function postCurl($url, $options, $header =
                    array('Accept'=>'application/json', 'Content-Type'=>'application/json'), $type = 'POST') {
        $curl = curl_init();
        // 访问地址
        curl_setopt($curl, CURLOPT_URL, $url);
        // 认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)');
        if (!empty($option)) {
            $options = json_encode($option);
            // Post提交的数据包
            curl_setopt($curl, CURLOPT_POSTFIELDS, $options );
        }
        // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_TIMEOUT, 30 );
        // 设置HTTP头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header );
        // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type );
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);

    }

    /*
     *  获取Token的值，根据官网所说，token的值存在一个默认时间，默认时间内token值有效，所以存储在一个文件内。如果
     *  超出时间，那么重新生成
     *
     */
    private function getToken() {
        // 判断是否超过默认的时间
        $fp = fopen(self::$TOKEN_FILE_PATH, "wr");
        $origRes = unserialize(fgets($fp));

        // 如果超过了默认的时间
        if(!isset($origRes['expires_in']) || $origRes['expires_in'] < time()) {
            $url = $this->url. "token";
            $options = array();
            $options['grant_type'] = 'client_credentials';
            $options['client_id'] = $this->clientId;
            $options['client_secret'] = $this->clientSecret;
            // 发送POST请求
            $result = $this->postCurl($url, $options);
            $result['expires_in'] = $result['expires_in'] + time();

            // 写回文件
            fwrite($fp, serialize($result));
            fclose($fp);
            // 返回token的值
            return $result['access_token'];

        } else {
            fclose($fp);
            return $origRes['access_token'];
        }
    }

    public function authorizeRegister($username, $password) {
        $url = $this->url. "users";
        $token = $this->getToken();
        $headers = array('Content-Type'=>'application/json', 'Authorization'=>'Bearer '.$token);
        $options = array();
        $options['username'] = $username;
        $options['password'] = $password;
        // 发送注册请求
        $result = $this->postCurl($url, $options, $headers);
    }

} 
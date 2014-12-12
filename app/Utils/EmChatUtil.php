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

    static $TOKEN_FILE_PATH = "./TokenInfo.info";
    static $LOG = "EmChatUtil";
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
    public function __construct() {
        $this->clientId = 'YXA60DJ2EHo5EeSRXf_M-DGFgg';
        $this->clientSecret = 'YXA6oGpdD71ERYRn4VNVQx9LU20P-ss';
        $this->orgName = 'heartway';
        $this->appName = 'heartway';
        if(!empty($this->orgName) && !empty($this->appName)) {
            $this->url = "https://a1.easemob.com/".$this->orgName.'/'.$this->appName.'/';
            // $this->url = "http://requestb.in/1gbs3zk1?inspect";
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
    public function postCurl($url, $option, $header =
                    array('Accept: application/json', 'Content-Type: application/json'), $type = 'POST') {
        $curl = curl_init();
        // 访问地址
        curl_setopt($curl, CURLOPT_URL, $url);
        // 认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)');
        if (!empty($option)) {
            $option = json_encode($option);
            // Post提交的数据包
            curl_setopt($curl, CURLOPT_POSTFIELDS, $option);
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
        return json_decode($result, true);

    }

    /*
     *  获取Token的值，根据官网所说，token的值存在一个默认时间，默认时间内token值有效，所以存储在一个文件内。如果
     *  超出时间，那么重新生成
     *
     */
    private function getToken() {

        // 判断是否超过默认的时间
        // $fp = fopen(self::$TOKEN_FILE_PATH, "w");

        if(!file_exists(self::$TOKEN_FILE_PATH)) {
            // 创建文件
            $fp = fopen(self::$TOKEN_FILE_PATH, 'w+');
            fclose($fp);
        }

        $origRes = unserialize(file_get_contents(self::$TOKEN_FILE_PATH));

        // 如果超过了默认的时间
        if(!isset($origRes['expires_in']) || $origRes['expires_in'] < time()) {
            print("send POST token<br/>");
            $url = $this->url. "token";
            $options = array();
            $options['grant_type'] = 'client_credentials';
            $options['client_id'] = $this->clientId;
            $options['client_secret'] = $this->clientSecret;
            // 发送POST请求
            $result = $this->postCurl($url, $options);

            if(isset($result['expires_in'])) {
                // echo "write to the file~~~~~~";
                $result['expires_in'] = $result['expires_in'] + time();
                // 写回文件
                $fp = fopen(self::$TOKEN_FILE_PATH, "w");
                fwrite($fp, serialize($result));
                fclose($fp);
                // 返回token的值
                return $result['access_token'];
            } else {
                return 0;
            }
        } else {
            // echo "read the file content";
            return $origRes['access_token'];
        }
    }

    /*
     * 授权注册用户信息
     * @param string $username: 用户名
     * @param string $password: 密码
     * @return array $result: 注册返回的信息
     *
     */
    public function authorizeRegister($username, $password) {
        $url = $this->url. "users";
        $token = $this->getToken();
        // print("tokens---------->".$token);

        $headers = array('Authorization: Bearer '.$token);
        $options = array();
        $options['username'] = $username;
        $options['password'] = $password;
        // 发送注册请求
        $result = $this->postCurl($url, $options, $headers);
        // print("after post Request");
        return $result;

    }


    /*
     * 删除环信中的用户信息
     *
     */
    public function deleteUser($subAccount) {
        $url = $this->url."users/".$subAccount;
        $token = $this->getToken();
        $header = array('Authorization: Bearer '.$token);
        $result = $this->postCurl($url,'', $header, $type = 'DELETE' );

        return $result;

    }

    /*
     *  给某人添加好友
     *
     */
    public function addFriend($mySubAccount, $youSubAccount) {
        $url = $this->url. "users/". $mySubAccount. "/contacts/users/". $youSubAccount;
        $token =$this->getToken();
        $header = array('Authorization: Bearer '.$token);
        $result = $this->postCurl($url, '', $header);
        return $result;
    }

} 
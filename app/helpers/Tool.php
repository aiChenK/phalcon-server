<?php

namespace app\helpers;

class Tool
{

    /**
     * 检查是否为windows系统
     *
     * @return bool
     *
     * create by ck 20170808
     */
    public static function isWindows()
    {
        return PATH_SEPARATOR == ';';
    }

    /**
     * 根据传入参数，组成路径返回
     *
     * @param $args
     * @return string
     *
     * create by ck 20170808
     * modify by ck 20181212    忽略无效参数
     */
    public static function buildPath($args)
    {
        $args = func_get_args();
        $path = [];
        for ($i = 0; $i < func_num_args(); $i++) {
            if (!$args[$i]) {
                continue;
            }
            $path[] = rtrim($args[$i], '/');
        }
        return implode('/', $path);
    }

    /**
     * 验证是否为手机号
     *
     * @param string $phone
     * @return int
     *
     * create by ck 20190225
     */
    public static function validPhone(string $phone)
    {
        return preg_match('/^1[3456789]{1}\d{9}$/', $phone);
    }

    /**
     * 验证是否为正确邮箱格式
     *
     * @param string $mail
     *
     * @return false|int
     *
     * create by dale  20190312
     */
    public static function validMail(string $mail)
    {
        return preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', $mail);
    }

    /**
     * 构建url
     *
     * @param string $path
     * @param array $params
     * @param string $scheme
     * @return string
     *
     * create by ck 20171214
     * modify by ck 20180413
     * modify by ck 20180824    更改方式
     */
    public static function buildUrl($path = '', $params = [], $scheme = '')
    {
        $scheme     = $scheme ?: $_SERVER['REQUEST_SCHEME'];
        $urlInfo    = parse_url($_SERVER['HTTP_HOST']);
        $serverName = isset($urlInfo['host']) ? $urlInfo['host'] : $urlInfo['path'];
        $port       = self::getValue($urlInfo, 'port');
        $baseUrl = preg_replace('/(public)*([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]) ?: '/';
        if (($scheme == 'http' && $port == 80) || ($scheme == 'https' && $port == 443)) {
            $port = '';
        } elseif ($port) {
            $port = ':' . $port;
        }
        $params = $params ? ('?' . http_build_query($params)) : '';
        return $scheme . '://' . $serverName . $port . $baseUrl . ltrim($path, '/') . $params;
    }

    /**
     * 检查数组中key是否存在并返回
     *
     * @param array $array
     * @param string $key
     * @param string $default
     * @param null $callback
     * @return mixed|string
     *
     * create by ck 20180419
     * modify by ck 20181120
     */
    public static function getValue(&$array, $key, $default = '', $callback = null)
    {
        if (!is_array($array)) {
            return $default;
        }
        return array_key_exists($key, $array)
            ? ($callback
                ? call_user_func($callback, $array[$key])
                : $array[$key])
            : $default;
    }

    /**
     * 检查数组中key是否都有效
     *
     * @param $array
     * @param $keys
     * @return bool
     *
     * create by ck 20190429
     */
    public static function checkValue(&$array, $keys)
    {
        if (is_string($keys)) {
            $keys = [$keys];
        }
        foreach ($keys as $key) {
            if (!self::getValue($array, $key)) {
                return false;
            }
        }
        return true;
    }


    /**
     * 获取随机数
     *
     * @param int $len
     * @param string $format
     * @return string
     *
     * create by ck 20180208
     */
    public static function getRand($len = 6, $format = 'NUMBER'){
        $isStr = $isNum = 0;
        $randNum = $tmp ='';
        switch($format){
            case 'ALL':
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
            case 'CHAR':
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                break;
            case 'NUMBER':
                $chars='0123456789';
                break;
            default :
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
        }
        while(strlen($randNum)<$len){
            $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
            if(($isNum <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
                $isNum = 1;
            }
            if(($isStr <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
                $isStr = 1;
            }
            $randNum.= $tmp;
        }
        if($isNum <> 1 || $isStr <> 1 || empty($randNum) ){
            $randNum = self::getRand($len, $format);
        }
        return $randNum;
    }

    /**
     * 获取IP地址
     *
     * @return array|false|string
     *
     * create by ck 20190725
     */
    public static function getIp()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } elseif (isset($_SERVER["HTTP_CLIENT_ip"])) {
                $ip = $_SERVER["HTTP_CLIENT_ip"];
            } elseif (isset($_SERVER["HTTP_CLIENT_ip"])) {
                $ip = $_SERVER["HTTP_CLIENT_ip"];
            } else {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_ip')) {
                $ip = getenv('HTTP_CLIENT_ip');
            } else {
                $ip = getenv('REMOTE_ADDR');
            }
        }
        if (trim($ip) == "::1") {
            $ip = "127.0.0.1";
        }
        if (is_string($ip)) {
            $ips = explode(',', $ip);
            $ip = end($ips);
        } elseif (is_array($ip)) {
            $ip = end($ip);
        }
        return $ip;
    }

}

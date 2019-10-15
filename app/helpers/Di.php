<?php
/**
 * 静态方式获取常用服务
 * User: aiChenK
 * Date: 2019-01-03
 * Time: 15:30
 */
namespace app\helpers;

use Phalcon\Di\Injectable;

class Di
{

    private static $diInjectable;

    public static function get(string $serviceName = '')
    {
        if (!self::$diInjectable instanceof DiInjectable) {
            self::$diInjectable = new DiInjectable();
        }
        return $serviceName
            ? self::$diInjectable->$serviceName
            : self::$diInjectable;
    }

}

/**
 * @property \Redis $redis
 */
class DiInjectable extends Injectable
{

}

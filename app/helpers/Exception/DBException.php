<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-01-23
 * Time: 15:24
 */

namespace app\helpers\Exception;

class DBException extends BaseException
{
    public function __construct($message = '数据库操作失败', $description = '')
    {
        parent::__construct($message, $description, 500);
    }
}

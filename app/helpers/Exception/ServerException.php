<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-01-23
 * Time: 15:24
 */

namespace app\helpers\Exception;

class ServerException extends BaseException
{
    public function __construct($description = '', int $code = 500)
    {
        parent::__construct('服务器内部错误', $description, $code);
    }
}

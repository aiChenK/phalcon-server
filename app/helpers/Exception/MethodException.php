<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-01-23
 * Time: 15:24
 */

namespace app\helpers\Exception;

class MethodException extends BaseException
{
    public function __construct($description = '暂不支持该方法')
    {
        parent::__construct('请求错误', $description, 500);
    }
}

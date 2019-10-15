<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-07-25
 * Time: 11:07
 */

namespace app\helpers\Exception;

class ParamException extends BaseException
{
    public function __construct($description = '', int $code = 400)
    {
        parent::__construct('参数有误', $description, $code);
    }
}

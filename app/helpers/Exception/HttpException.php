<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-01-23
 * Time: 15:24
 */

namespace app\helpers\Exception;

class HttpException extends BaseException
{
    public function __construct(string $message = '', $description = '', int $code = 500)
    {
        parent::__construct($message, $description, $code);
    }
}

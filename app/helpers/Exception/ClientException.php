<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-01-23
 * Time: 15:24
 */

namespace app\helpers\Exception;

class ClientException extends BaseException
{
    public function __construct(string $message = '', $description = '', int $code = 400)
    {
        parent::__construct($message, $description, $code);
    }
}
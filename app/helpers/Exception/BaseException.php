<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-01-23
 * Time: 15:24
 */

namespace app\helpers\Exception;

abstract class BaseException extends \Exception
{

    protected $description;

    /**
     * BaseException constructor.
     * @param string $message
     * @param mixed $description
     * @param int $code
     */
    public function __construct(string $message = '', $description = '', int $code = 0)
    {
        $this->message     = $message;
        $this->description = $description;
        $this->code        = $code;
    }

    final public function getDescription($jsonEncode = false)
    {
        return $jsonEncode ? json_encode($this->description, JSON_UNESCAPED_UNICODE) : $this->description;
    }
}

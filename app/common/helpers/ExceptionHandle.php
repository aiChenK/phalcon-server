<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-04-15
 * Time: 15:56
 */

namespace app\common\helpers;

class ExceptionHandle
{
    public function render(\Throwable $e)
    {
        ob_clean();
        $controller = new BaseController();
        header('Content-Type: application/json');
        echo $controller->error(
            200,
            $e->getMessage()
        )->getContent();
    }
}
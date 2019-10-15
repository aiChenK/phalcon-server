<?php

namespace app\controllers;

use app\helpers\Exception\MethodException;

class IndexController extends Base
{

    public function indexAction()
    {
        echo 'phalcon-server';
    }

    public function notFoundAction()
    {
        throw new MethodException();
    }

    public function aliveAction()
    {
        return $this->json([
            'code'   => 200,
            'msg'    => '返回成功',
            'detail' => []
        ]);
    }

}


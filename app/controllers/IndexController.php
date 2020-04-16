<?php

namespace app\controllers;

class IndexController extends Base
{
    public function indexAction()
    {
        echo 'phalcon-server';
    }

    public function notFoundAction()
    {
        return $this->error(404, '请求错误：暂不支持该接口');
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
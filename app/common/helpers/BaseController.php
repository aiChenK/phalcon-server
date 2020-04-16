<?php

namespace app\common\helpers;

use Phalcon\Mvc\Controller as PhalconController;

class BaseController extends PhalconController
{
    public function json(array $data = [], int $httpCode = 200)
    {
        $this->response->setStatusCode($httpCode);
        if ($httpCode == 204) {
            return $this->response;
        }
        return $this->response->setJsonContent($data, JSON_UNESCAPED_UNICODE);
    }

    public function success(string $msg = '', int $httpCode = 200)
    {
        $msg = $msg ?: 'success';
        $data = ['msg' => $msg];
        return $this->json($data, $httpCode);
    }

    public function error(int $httpCode = 200, string $msg = '未知错误', string $description = '', int $code = 0)
    {
        $data = ['code' => $code ?: $httpCode, 'msg' => $msg, 'description' => $description];
        return $this->json($data, $httpCode);
    }

    public function text(string $content, int $httpCode = 200)
    {
        return $this->response->setStatusCode($httpCode)->setContent($content);
    }

    public function getJson()
    {
        return $this->request->getJsonRawBody(true);
    }
}
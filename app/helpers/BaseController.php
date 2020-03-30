<?php

namespace app\helpers;

use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller as PhalconController;

class BaseController extends PhalconController
{

    /**
     * 返回失败
     *
     * @param int $code
     * @param string $msg
     * @param string $description
     * @param array $errors
     * @return Response|ResponseInterface
     *
     * create by ck 20190725
     * modify by ck 20190806
     */
    public function error($code = 200, $msg = '未知错误', $description = '', $errors = [])
    {
        $content = ['code' => $code, 'msg' => $msg, 'description' => $description, 'errors' => $errors];
        return $this->response->setStatusCode($code)->setJsonContent($content, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 返回成功
     *
     * @param string $msg
     * @param int $code
     * @return Response|ResponseInterface
     *
     * create by ck 20190725
     * modify by ck 20190806
     */
    public function success($msg = '', $code = 200)
    {
        $msg = $msg ?: '成功！';
        $response = ['code' => $code ?: 200, 'msg' => $msg];
        return $this->response->setJsonContent($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 返回成功json消息
     *
     * @param array $data
     * @return Response|ResponseInterface
     *
     * create by ck 20190725
     * modify by ck 20190806
     */
    public function json($data = [])
    {
        return $this->response->setJsonContent($data, JSON_UNESCAPED_UNICODE);
    }
}

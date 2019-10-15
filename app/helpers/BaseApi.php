<?php

namespace app\helpers;

use Phalcon\Di;
use app\helpers\Exception\MethodException;

class BaseApi
{

    /**
     * @var \Phalcon\Db\Adapter
     */
    public $db;

    /**
     * @var \Phalcon\Http\Request
     */
    public $request;

    /**
     * @var \Phalcon\Http\Response
     */
    public $response;

    /**
     * @var \Phalcon\Mvc\Dispatcher
     */
    public $dispatcher;

    /**
     * 初始化服务
     */
    public function __construct()
    {
        $di = Di::getDefault();
        $this->db         = $di->get('db');
        $this->request    = $di->get('request');
        $this->response   = $di->get('response');
        $this->dispatcher = $di->get('dispatcher');
    }

    public function json($data = null)
    {
        return $this->response->setJsonContent($data, JSON_UNESCAPED_UNICODE);
    }

    public function success($msg = '', $code = 200)
    {
        $msg = $msg ?: '成功！';
        $response = ['code' => $code ?: 200, 'msg' => $msg];
        return $this->response->setJsonContent($response, JSON_UNESCAPED_UNICODE);
    }

    public function error($code = 200, $msg = '未知错误', $description = '', $errors = [])
    {
        $content = ['code' => $code, 'msg' => $msg, 'description' => $description, 'errors' => $errors];
        return $this->response->setStatusCode($code)->setJsonContent($content, JSON_UNESCAPED_UNICODE);
    }

    public function text($content, $code = 200)
    {
        return $this->response->setStatusCode($code)->setContent($content);
    }

    /**
     * 检查请求类型
     *
     * @param string $methods
     * @throws MethodException
     *
     * create by ck 20190725
     */
    protected function checkMethod($methods = 'get')
    {
        if (is_string($methods)) {
            $methods = [$methods];
        }
        $check = false;
        foreach ($methods as $method) {
            if (strtolower($this->request->getMethod()) == $method) {
                $check = true;
                break;
            }
        }
        if (!$check) {
            throw new MethodException();
        }
    }

    public function getJson()
    {
        return $this->request->getJsonRawBody(true);
    }
}
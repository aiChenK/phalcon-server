<?php

namespace app\common\helpers;

class BaseApi extends BaseController
{
    /**
     * @var ApiRouter
     */
    protected $apiRouter;

    public function _setApiRouter(string $version, string $controller, string $action, string $module = '')
    {
        $this->apiRouter = new ApiRouter($version, $controller, $action, $module);
    }

    public function _initialize()
    {
        // 初始化操作
    }

    protected function checkMethod($methods = 'get')
    {
        if (is_string($methods)) {
            $methods = [$methods];
        }
        foreach ($methods as $method) {
            if (strtolower($this->request->getMethod()) == $method) {
                return true;
            }
        }
        return false;
    }
}
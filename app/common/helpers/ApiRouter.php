<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-04-15
 * Time: 16:26
 */

namespace app\common\helpers;

class ApiRouter
{
    private $version;
    private $module;
    private $controller;
    private $action;

    public function __construct(string $version, string $controller, string $action, string $module = '')
    {
        $this->version    = $version;
        $this->module     = lcfirst($module);
        $this->controller = lcfirst($controller);
        $this->action     = lcfirst($action);
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getRequestPath()
    {
        return str_replace('//', '/', implode('/', [
            $this->version,
            $this->module,
            $this->controller,
            $this->action
        ]));
    }
}
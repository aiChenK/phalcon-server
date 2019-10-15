<?php

namespace app\controllers;

use app\helpers\Tool;
use app\helpers\Exception\MethodException;

class ApiController extends Base
{

    /**
     * 执行api调用
     *
     * @return mixed
     * @throws MethodException
     *
     * create by ck 20190917
     */
    public function indexAction()
    {
        $params  = $this->dispatcher->getParams();
        $version = $params['version'];
        $module  = Tool::getValue($params, 0, '', function ($val) {
            return ucfirst($val);
        });
        $function= Tool::getValue($params, 1, 'index');
        unset($params['version'], $params[0], $params[1]);

        $params = array_values($params);
        $className = "\\app\\api\\v{$version}\\{$module}";
        //todo 检查className是否为文件夹，是则添加下一级params
        $realMethod = $function . ucfirst(strtolower($this->request->getMethod()));
        if (!class_exists($className)) {
            throw new MethodException();
        }
        if (method_exists($className, $realMethod)) {
            return call_user_func_array([new $className(), $realMethod], $params);
        } elseif (method_exists($className, $function)) {
            return call_user_func_array([new $className(), $function], $params);
        } else {
            throw new MethodException();
        }
    }

}


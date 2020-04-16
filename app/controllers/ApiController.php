<?php

namespace app\controllers;

class ApiController extends Base
{
    /**
     * 处理路由
     *
     * @param $version
     * @param $module
     * @param $submodule
     * @param $action
     * @param $params
     * @return string
     *
     * create by aiChenK 20200416
     */
    private function _router($version, &$module, &$submodule, &$action, &$params)
    {
        //包含模块
        $className = "\\app\\api\\v{$version}\\{$module}\\{$submodule}";
        if (class_exists($className)) {
            return $className;
        }

        //不包含模块
        array_unshift($params, $action);
        $action    = lcfirst($submodule);
        $submodule = ucfirst($module);
        $module    = '';
        $className = "\\app\\api\\v{$version}\\{$submodule}";
        if (class_exists($className)) {
            return $className;
        }
        return $this->error(404, '请求错误：暂不支持该接口');
    }

    /**
     * 执行api调用
     *
     * @return mixed
     *
     * create by aiChenK 20190917
     * modify by aiChenK 20200415   增加调用_initialize方法，去除Tool依赖
     */
    public function indexAction()
    {
        $params  = $this->dispatcher->getParams();
        $version = $params['version'];
        unset($params['version']);

        //模块预处理
        $module    = $params[0] ?? 'index';
        $submodule = ucfirst($params[1] ?? 'index');
        $action    = $params[2] ?? 'index';
        unset($params[0], $params[1], $params[2]);
        $params = array_values($params);

        //执行方法
        $className  = $this->_router($version, $module, $submodule, $action, $params);
        $restAction = $action . ucfirst(strtolower($this->request->getMethod()));
        $class      = new $className();
        call_user_func_array([$class, '_setApiRouter'], ['v'. $version, $submodule, $action, $module]);
        call_user_func([$class, '_initialize']);
        if (method_exists($class, $restAction)) {
            return call_user_func_array([$class, $restAction], $params);
        } elseif (method_exists($class, $action)) {
            return call_user_func_array([$class, $action], $params);
        } else {
            return $this->error(404, '请求错误：暂不支持该接口');
        }
    }
}
<?php

$config = new \Phalcon\Config([
    'application' => [
        'appDir'          => APP_PATH . '/',
        'controllersDir'  => APP_PATH . '/controllers/',
        'modelsDir'       => APP_PATH . '/models/',
        'viewsDir'        => APP_PATH . '/views/',
//        'cacheDir'        => BASE_PATH . '/cache/',
        'baseUri'         => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],
    'exceptionHandle' => '\\app\\common\\helpers\\ExceptionHandle'
]);

$config->merge(new \Phalcon\Config\Adapter\Ini(BASE_PATH . '/web.ini'));

//处理异常
$exceptionHandler = $config->get('exceptionHandle');
if ($exceptionHandler) {
    set_exception_handler([$exceptionHandler, 'render']);
}

return $config;

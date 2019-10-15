<?php

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$config = new \Phalcon\Config([
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'viewsDir'       => APP_PATH . '/views/',
//        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ]
]);

$config->merge(new \Phalcon\Config\Adapter\Ini(BASE_PATH . '/web.ini'));

defined('PROJECT_NAME') || define('PROJECT_NAME', $config->get('NAME','default'));
defined('MODE_NAME') || define('MODE_NAME', $config->get('MODE','pro'));
error_reporting(MODE_NAME == 'dev' ? E_ALL : 0);

return $config;

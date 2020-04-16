<?php

use Phalcon\Di\FactoryDefault;

date_default_timezone_set("PRC");

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('START_TIME', $_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(true));
define('START_MEM', memory_get_usage());

/**
 * The FactoryDefault Dependency Injector automatically registers
 * the services that provide a full stack framework.
 */
$di = new FactoryDefault();

/**
 * Include Composer Autoloader
 */
include BASE_PATH . '/vendor/autoload.php';

/**
 * Handle routes
 */
include APP_PATH . '/config/router.php';

/**
 * Read services
 */
include APP_PATH . '/config/services.php';
include APP_PATH . '/config/services_web.php';

/**
 * Get config service for use in inline setup below
 */
$config = $di->getConfig();

/**
 * Handle the request
 */
$application = new \Phalcon\Mvc\Application($di);

echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());
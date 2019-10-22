<?php
use Phalcon\Di\FactoryDefault;
use app\helpers\Di;
use app\helpers\BaseController;
use app\helpers\Exception\BaseException;

date_default_timezone_set("PRC");

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('START_TIME', microtime(true));
define('START_MEM', memory_get_usage());

// 自定义异常处理函数
set_exception_handler('exception_handler');

/**
 * The FactoryDefault Dependency Injector automatically registers
 * the services that provide a full stack framework.
 */
$di = new FactoryDefault();

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
 * Include Autoloader
 */
include APP_PATH . '/config/loader.php';

/**
 * Include Composer Autoloader
 */
include BASE_PATH . '/vendor/autoload.php';

/**
 * Handle the request
 */
$application = new \Phalcon\Mvc\Application($di);

echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());

/**
 * 异常处理函数
 *
 * @param \Throwable|\Exception|\Error $exception
 *
 * create by ck 20190220
 */
function exception_handler($exception)
{
    $_code = strlen($exception->getCode()) === 3 ? $exception->getCode() : 500;
    $_detail = $exception->getTrace();
    if ($exception instanceof BaseException) {
        $_detail = $exception->getDescription();
    }

    ob_clean();
    $controller = new BaseController();
    header('HTTP/1.0 ' . $_code);
    header('Content-Type: application/json');
    echo $controller->error(
        $_code,
        $exception->getMessage(),
        $_detail
    )->getContent();
}



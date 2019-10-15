<?php

use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});



/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
//$di->setShared('modelsMetadata', function () {
//    return new MetaDataAdapter();
//});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
//$di->set('flash', function () {
//    return new Flash([
//        'error'   => 'alert alert-danger',
//        'success' => 'alert alert-success',
//        'notice'  => 'alert alert-info',
//        'warning' => 'alert alert-warning'
//    ]);
//});

/**
 * Start the session the first time some component request the session service
 */
//$di->setShared('session', function () {
//    $session = new SessionAdapter();
//    $session->start();
//
//    return $session;
//});



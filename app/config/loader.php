<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces([
    'app'      => APP_PATH . '/',
]);

//$eventsManager = new \Phalcon\Events\Manager();
//$eventsManager->attach('loader', function($event, $loader) {
//    if ($event->getType() == 'beforeCheckPath') {
//        echo $loader->getCheckedPath() .'<br/>';
//    }
//});
//$loader->setEventsManager($eventsManager);

/**
 * We're a registering a set of directories taken from the configuration file
 */
//$loader->registerDirs(
//    [
//        $config->application->controllersDir,
//        $config->application->modelsDir
//    ]
//)->register();

$loader->register();
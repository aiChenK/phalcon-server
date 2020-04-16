<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $view = new View();
    $view->disable();

//    $config = $this->getConfig();
//    $view = new View();
//    $view->setDI($this);
//    $view->setViewsDir($config->application->viewsDir);
//    $view->registerEngines([
//        '.volt' => function ($view) {
//            $config = $this->getConfig();
//
//            $volt = new VoltEngine($view, $this);
//
//            $volt->setOptions([
//                'compiledPath' => $config->application->cacheDir,
//                'compiledSeparator' => '_'
//            ]);
//
//            return $volt;
//        },
//        '.phtml' => PhpEngine::class
//
//    ]);

    return $view;
});

/**
 * Set the default namespace for dispatcher
 */
$di->setShared('dispatcher', function () use ($di) {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('app\\controllers');

    $evManager = $di->getShared('eventsManager');
    $evManager->attach(
        "dispatch:beforeException",
        function ($event, Dispatcher $dispatcher, \Exception $exception) {
            switch ($exception->getCode()) {
                case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'notFound',
                    ]);
                    return false;
            }
            return true;
        }
    );
    $dispatcher->setEventsManager($evManager);
    return $dispatcher;
});
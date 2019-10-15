<?php

use Phalcon\Cli\Dispatcher;

/**
 * Set the default namespace for dispatcher
 */
$di->setShared('dispatcher', function() use ($di){
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('app\cli\tasks');

    $evManager = $di->getShared('eventsManager');
    $evManager->attach(
        "dispatch:beforeException",
        function($event, Dispatcher $dispatcher, \Throwable $exception)
        {
            switch ($exception->getCode()) {
                case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward([
                        'task'      => 'main',
                        'action'    => 'notFound',
                    ]);
                    return false;
            }
            return true;
        }
    );
    $dispatcher->setEventsManager($evManager);

    return $dispatcher;
});
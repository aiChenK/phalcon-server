<?php

$router = $di->getRouter();

// Define your routes here
$router->add('/:params', [
    'namespace' => 'app\\controllers',
    'controller' => 'index',
    'action' => 'index',
    'params' => 1
]);
$router->add('/:controller/:params', [
    'namespace' => 'app\\controllers',
    'controller' => 1,
    'action' => 'index',
    'params' => 2
]);
$router->add('/:controller/:action/:params', [
    'namespace' => 'app\\controllers',
    'controller' => 1,
    'action' => 2,
    'params' => 3
]);
$router->add('/api/v([0-9]+)/:params', [
    'namespace' => 'app\\controllers',
    'controller' => 'api',
    'action' => 'index',
    'version' => 1,
    'params' => 2
]);

$router->handle();

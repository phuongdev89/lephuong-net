<?php

$router = new Phalcon\Mvc\Router(false);

$router->add('/:controller/:action/:params', [
    'namespace'  => 'frontend\controllers',
    'controller' => 1,
    'action'     => 2,
    'params'     => 3,
]);

$router->add('/:controller', [
    'namespace'  => 'frontend\controllers',
    'controller' => 1
]);

return $router;

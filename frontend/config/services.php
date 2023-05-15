<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Dispatcher;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 * @var FactoryDefault $di
 */
$di->setShared('router', function () {
    return require __DIR__ . '/routes.php';
});

$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('frontend\controllers');

    return $dispatcher;
});

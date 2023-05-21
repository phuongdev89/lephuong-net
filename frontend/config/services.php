<?php

use Phalcon\Config;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Dispatcher;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 * @var FactoryDefault $di
 * @var Config $config
 */
$di->setShared('router', function () {
    return require __DIR__ . '/routes.php';
});

$di->set('dispatcher', function () use ($config) {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace($config->defaultNamespace);

    return $dispatcher;
});

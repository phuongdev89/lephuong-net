<?php

use backend\plugins\NotFoundPlugin;
use backend\plugins\SecurityPlugin;
use Phalcon\Config;
use Phalcon\Di\FactoryDefault;
use Phalcon\Events\Manager as EventManager;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;
use Phalcon\Mvc\Dispatcher;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 * @var FactoryDefault $di
 * @var Config $config
 */
$di->setShared('router', function () {
    return require __DIR__ . '/routes.php';
});

$di->setShared('dispatcher', function () use ($config) {
    $eventsManager = new EventManager();

    $eventsManager->attach(
        'dispatch:beforeExecuteRoute',
        new SecurityPlugin()
    );

    $eventsManager->attach(
        'dispatch:beforeException',
        new NotFoundPlugin()
    );
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace($config->defaultNamespace);
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

$di->set('logger', function () {
    $adapter = new Stream(__DIR__ . '/../storage/logs/main.log');
    return new Logger(
        'messages',
        [
            'main' => $adapter,
        ]
    );
});

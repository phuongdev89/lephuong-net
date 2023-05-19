<?php

use Phalcon\Cli\Dispatcher;
use Phalcon\Config;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault\Cli as CliDI;

/**
 * @var Config $config
 */

$container = new CliDI();
$di = new Dispatcher();

$container->setShared('config', $config);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$container->set('db', function () use ($config) {
    return new DbAdapter(
        [
            'host' => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname' => $config->database->dbname
        ]
    );
});

$container->set('dispatcher', function () use ($config) {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace($config->defaultNamespace);

    return $dispatcher;
});

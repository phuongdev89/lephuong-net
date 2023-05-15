<?php

use Phalcon\Config;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Redis as RedisAdapter;
use Phalcon\Session\Manager;
use Phalcon\Storage\AdapterFactory;
use Phalcon\Storage\SerializerFactory;
use Phalcon\Url as UrlResolver;

/**
 * @var Config $config
 */
$di = new FactoryDefault();
/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(
        [
            '.volt' => function ($view) use ($config) {
                $volt = new VoltEngine($view, $this);

                $volt->setOptions(
                    [
                        'path' => $config->application->cacheDir,
                        'separator' => '_'
                    ]
                );

                return $volt;
            },
            // Generate Template files uses PHP itself as the template engine
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
        ]
    );

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter(
        [
            'host' => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname' => $config->database->dbname
        ]
    );
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () use ($config) {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () use ($config) {
    $session = new Manager();
    $serializerFactory = new SerializerFactory();
    $factory = new AdapterFactory($serializerFactory);
    $redis = new RedisAdapter($factory, [
        'prefix' => $config->redis->prefix,
        'host' => $config->redis->host,
        'port' => $config->redis->port,
        'index' => $config->redis->index,
        'persistent' => $config->redis->persistent,
        'auth' => $config->redis->auth,
        'socket' => $config->redis->socket
    ]);

    $session
        ->setAdapter($redis)
        ->start();
});

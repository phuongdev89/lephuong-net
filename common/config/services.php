<?php

use Phalcon\Config;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Security;
use Phalcon\Session\Adapter\Libmemcached;
use Phalcon\Session\Adapter\Noop;
use Phalcon\Session\Adapter\Redis;
use Phalcon\Session\Adapter\Stream;
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
    $view->setLayoutsDir($config->application->viewsDir . 'layouts/');

    $view->registerEngines(
        [
            '.volt' => function ($view) use ($config) {
                $volt = new VoltEngine($view, $this);

                $volt->setOptions(
                    [
                        'path' => $config->application->storageDir . 'cache/',
                        'separator' => '_',
                        'always' => PHALCON_DEBUG && PHALCON_ENV == 'dev'
                    ]
                );

                return $volt;
            },
            // Generate Template files uses PHP itself as the template engine
            '.php' => 'Phalcon\Mvc\View\Engine\Php',
        ]
    );

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    $options = $config->database->toArray();
    $class = $options['class'];
    unset($options['class']);
    return new $class($options);
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
    $options = $config->session->toArray();
    $class = $options['class'];
    unset($options['class']);
    switch ($class) {
        case Redis::class:
            $serializerFactory = new SerializerFactory();
            $factory = new AdapterFactory($serializerFactory);
            $adapter = new Redis($factory, $options);
            break;
        case Libmemcached::class:
            $serializerFactory = new SerializerFactory();
            $factory = new AdapterFactory($serializerFactory);
            $adapter = new Libmemcached($factory, $options);
            break;
        case Noop::class:
            $adapter = new Noop();
            break;
        case Stream::class:
        default:
            $adapter = new Stream(
                [
                    'savePath' => $config->application->storageDir . 'tmp/',
                ]
            );
            break;
    }

    $session
        ->setAdapter($adapter)
        ->start();
});

$di->set(
    'security',
    function () {
        $security = new Security();

        $security->setWorkFactor(12);

        return $security;
    },
    true
);

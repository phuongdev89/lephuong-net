<?php

/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        [
            'console\components' => __DIR__ . '/../components/',
            'console\tasks' => __DIR__ . '/../tasks/',
            'console\models' => __DIR__ . '/../models/'
        ]
    )->register();

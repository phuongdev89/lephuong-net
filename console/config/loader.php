<?php

/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        array_merge_recursive(
            $loader->getNamespaces(), [
                'console\components' => APP_PATH . '/bases/',
                'console\tasks' => APP_PATH . '/tasks/',
                'console\models' => APP_PATH . '/models/'
            ]
        )
    )->register();

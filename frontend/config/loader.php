<?php

/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        array_merge_recursive(
            $loader->getNamespaces(),
            [
                'frontend\bases' => APP_PATH . '/bases/',
                'frontend\controllers' => APP_PATH . '/controllers/',
                'frontend\models' => APP_PATH . '/models/',
                'frontend\helpers' => APP_PATH . '/helpers/',
                'frontend\widgets' => APP_PATH . '/widgets/',
            ]
        )
    )->register();

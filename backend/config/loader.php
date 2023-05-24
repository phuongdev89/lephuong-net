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
                'backend\bases' => APP_PATH . '/bases/',
                'backend\controllers' => APP_PATH . '/controllers/',
                'backend\controllers\admin' => APP_PATH . '/controllers/admin',
                'backend\helpers' => APP_PATH . '/helpers/',
                'backend\models' => APP_PATH . '/models/',
                'backend\plugins' => APP_PATH . '/plugins/',
                'backend\widgets' => APP_PATH . '/widgets/',
            ]
        )
    )->register();

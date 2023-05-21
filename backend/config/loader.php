<?php

/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        [
            'backend\bases' => __DIR__ . '/../bases/',
            'backend\controllers' => __DIR__ . '/../controllers/',
            'backend\controllers\admin' => __DIR__ . '/../controllers/admin',
            'backend\models' => __DIR__ . '/../models/',
            'backend\helpers' => __DIR__ . '/../helpers/',
            'backend\widgets' => __DIR__ . '/../widgets/',
            'backend\plugins' => __DIR__ . '/../plugins/',
        ]
    )->register();

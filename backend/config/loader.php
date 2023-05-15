<?php


/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        [
            'backend\components' => __DIR__ . '/../components/',
            'backend\controllers' => __DIR__ . '/../controllers/',
            'backend\controllers\admin' => __DIR__ . '/../controllers/admin'
        ]
    )->register();

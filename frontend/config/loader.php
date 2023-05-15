<?php


/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        [
            'frontend\components' => __DIR__ . '/../components/',
            'frontend\controllers' => __DIR__ . '/../controllers/',
            'frontend\controllers\admin' => __DIR__ . '/../controllers/admin'
        ]
    )->register();

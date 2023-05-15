<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerNamespaces(
        [
            'common\components' => __DIR__ . '/../components/',
            'common\models' => __DIR__ . '/../models/',
            'common\helpers' => __DIR__ . '/../helpers/',
        ]
    )->register();

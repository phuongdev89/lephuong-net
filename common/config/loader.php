<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerNamespaces(
        [
            'common\bases' => __DIR__ . '/../bases/',
            'common\models' => __DIR__ . '/../models/',
            'common\helpers' => __DIR__ . '/../helpers/',
        ]
    )->register();

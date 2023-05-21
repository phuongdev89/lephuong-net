<?php

/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        [
            'frontend\bases' => __DIR__ . '/../bases/',
            'frontend\controllers' => __DIR__ . '/../controllers/',
            'frontend\models' => __DIR__ . '/../models/',
            'frontend\helpers' => __DIR__ . '/../helpers/',
            'frontend\widgets' => __DIR__ . '/../widgets/',
        ]
    )->register();

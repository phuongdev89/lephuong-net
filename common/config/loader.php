<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerNamespaces(
        [
            'common\bases' => ROOT_PATH . '/common/bases/',
            'common\models' => ROOT_PATH . '/common/models/',
            'common\helpers' => ROOT_PATH . '/common/helpers/',
        ]
    )->register();

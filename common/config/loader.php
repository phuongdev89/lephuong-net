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
            'common\enums' => ROOT_PATH . '/common/enums/',
            'common\helpers' => ROOT_PATH . '/common/helpers/',
            'common\interfaces' => ROOT_PATH . '/common/interfaces/',
            'common\models' => ROOT_PATH . '/common/models/',
            'common\plugins' => ROOT_PATH . '/common/plugins/',
        ]
    )->register();

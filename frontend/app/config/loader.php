<?php


/**
 * We're a registering a set of directories taken from the configuration file
 * @var Loader $loader
 */

use Phalcon\Loader;

$loader
    ->registerNamespaces(
        [
            'MyApp\Controllers' => __DIR__ . '/../controllers/',
            'MyApp\Controllers\Admin' => __DIR__ . '/../controllers/admin'
        ]
    )->register();

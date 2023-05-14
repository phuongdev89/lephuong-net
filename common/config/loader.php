<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerNamespaces(
        [
            'Common\Components' => __DIR__ . '/../components/',
            'Common\Models' => __DIR__ . '/../models/',
        ]
    )->register();

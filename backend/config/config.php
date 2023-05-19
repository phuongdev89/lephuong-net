<?php

use Phalcon\Config;

$config = array_merge(
    require __DIR__ . "/../../common/config/config.php",
    [
        'application' => [
            'controllersDir' => __DIR__ . '/../controllers/',
            'modelsDir' => __DIR__ . '/../models/',
            'viewsDir' => __DIR__ . '/../views/',
            'pluginsDir' => __DIR__ . '/../plugins/',
            'libraryDir' => __DIR__ . '/../library/',
            'cacheDir' => __DIR__ . '/../cache/',
            'migrationsDir' => __DIR__ . '/../../console/migrations/',
            'baseUri' => '/',
        ],
    ]
);

return new Config($config);

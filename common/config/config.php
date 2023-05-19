<?php

return array_merge_recursive(
    require "config-local.php",
    [
        'application' => [
            'migrationsDir' => __DIR__ . '/../../console/migrations/',
            'baseUri' => '/',
        ],
    ]
);

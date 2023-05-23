<?php

return array_merge_recursive(
    require "config-local.php",
    [
        'application' => [
            'migrationsDir' => ROOT_PATH . '/console/migrations/',
            'baseUri' => '/',
        ],
    ]
);

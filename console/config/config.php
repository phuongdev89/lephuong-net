<?php

return array_merge_recursive(
    require __DIR__ . "/../../common/config/config.php",
    [
        'defaultNamespace' => 'console\tasks',
        'application' => [
            'tasksDir' => __DIR__ . '/../tasks/',
            'modelsDir' => __DIR__ . '/../models/',
            'storageDir' => __DIR__ . '/../storage/',
        ],
    ]
);


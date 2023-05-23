<?php

return array_merge_recursive(
    require ROOT_PATH . "/common/config/config.php",
    [
        'defaultNamespace' => 'console\tasks',
        'application' => [
            'tasksDir' => APP_PATH . '/tasks/',
            'modelsDir' => APP_PATH . '/models/',
            'storageDir' => APP_PATH . '/storage/',
        ],
    ]
);


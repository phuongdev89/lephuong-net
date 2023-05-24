<?php

return array_merge_recursive(
    require ROOT_PATH . "/common/config/config.php",
    [
        'defaultNamespace' => 'backend\controllers',
        'application' => [
            'basesDir' => APP_PATH . '/bases/',
            'controllersDir' => APP_PATH . '/controllers/',
            'helpersDir' => APP_PATH . '/helpers/',
            'modelsDir' => APP_PATH . '/models/',
            'pluginsDir' => APP_PATH . '/plugins/',
            'storageDir' => APP_PATH . '/storage/',
            'viewsDir' => APP_PATH . '/views/',
            'widgetsDir' => APP_PATH . '/widgets/',
        ],
    ]
);

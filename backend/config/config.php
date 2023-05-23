<?php

return array_merge_recursive(
    require ROOT_PATH . "/common/config/config.php",
    [
        'defaultNamespace' => 'backend\controllers',
        'application' => [
            'basesDir' => APP_PATH . '/bases/',
            'controllersDir' => APP_PATH . '/controllers/',
            'modelsDir' => APP_PATH . '/models/',
            'viewsDir' => APP_PATH . '/views/',
            'pluginsDir' => APP_PATH . '/plugins/',
            'widgetsDir' => APP_PATH . '/widgets/',
            'helpersDir' => APP_PATH . '/helpers/',
            'storageDir' => APP_PATH . '/storage/',
        ],
    ]
);

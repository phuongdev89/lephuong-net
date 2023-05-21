<?php

return array_merge_recursive(
    require __DIR__ . "/../../common/config/config.php",
    [
        'defaultNamespace' => 'backend\controllers',
        'application' => [
            'basesDir' => __DIR__ . '/../bases/',
            'controllersDir' => __DIR__ . '/../controllers/',
            'modelsDir' => __DIR__ . '/../models/',
            'viewsDir' => __DIR__ . '/../views/',
            'pluginsDir' => __DIR__ . '/../plugins/',
            'widgetsDir' => __DIR__ . '/../widgets/',
            'helpersDir' => __DIR__ . '/../helpers/',
            'storageDir' => __DIR__ . '/../storage/',
        ],
    ]
);

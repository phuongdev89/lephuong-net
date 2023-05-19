<?php

return [
    'security' => [
        'workFactor' => 12,
        'luggageKey' => ''
    ],
    'database' => [
        'class' => 'Phalcon\Db\Adapter\Pdo\Mysql',
        'host' => 'localhost',
        'port' => 3306,
        'username' => 'root',
        'password' => '',
        'dbname' => 'phalcon',
        'charset' => 'utf8',
    ],
    'session' => [
        'class' => 'Phalcon\Session\Adapter\Stream',
    ]
];

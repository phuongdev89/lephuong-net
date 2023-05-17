<?php

return [
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'mysql',
        'dbname' => 'lephuong_net',
        'charset'=>'utf8'
    ],
    'redis' => [
        'prefix' => 'sess-reds-',
        'host' => '127.0.0.1',
        'port' => 6379,
        'index' => 0,
        'persistent' => false,
        'auth' => '',
        'socket' => ''
    ]
];

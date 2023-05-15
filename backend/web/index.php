<?php

error_reporting(E_ALL);

use Phalcon\Config;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

/**
 * @var FactoryDefault $di
 */
try {

    /**
     * Read the configuration
     */
    $config = new Config(
        array_merge(
            require __DIR__ . "/../../common/config/config.php",
            require __DIR__ . "/../config/config.php"
        )
    );

    /**
     * Read auto-loader
     */
    require __DIR__ . '/../../common/config/loader.php';
    require __DIR__ . "/../config/loader.php";

    /**
     * Read services
     */
    require __DIR__ . '/../../common/config/services.php';
    require __DIR__ . "/../config/services.php";

    /**
     * Handle the request
     */
    $application = new Application($di);

    $response = $application->handle($_SERVER['REQUEST_URI']);

    $response->send();
} catch (Exception $e) {
    echo $e->getMessage();
}

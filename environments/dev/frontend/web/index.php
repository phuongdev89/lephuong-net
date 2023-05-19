<?php

error_reporting(E_ALL);
defined('PHALCON_DEBUG') or define('PHALCON_DEBUG', true);
defined('PHALCON_ENV') or define('PHALCON_ENV', 'dev');

use Phalcon\Config;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

/**
 * @var FactoryDefault $di
 */
require __DIR__ . '/../../vendor/autoload.php';

/**
 * Read the configuration
 */
$config = new Config(array_merge_recursive(
    require __DIR__ . "/../config/config.php",
    require __DIR__ . "/../config/config-local.php",
));

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
new Whoops\Provider\Phalcon\WhoopsServiceProvider($di);

$response = $application->handle($_SERVER['REQUEST_URI']);

$response->send();

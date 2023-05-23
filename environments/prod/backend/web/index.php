<?php

error_reporting(E_ALL);
defined('PHALCON_DEBUG') or define('PHALCON_DEBUG', false);
defined('PHALCON_ENV') or define('PHALCON_ENV', 'prod');
defined('APP_PATH') or define('APP_PATH', dirname(__DIR__));
defined('ROOT_PATH') or define('ROOT_PATH', dirname(APP_PATH));

use Phalcon\Config;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

/**
 * @var FactoryDefault $di
 */
require_once ROOT_PATH . '/vendor/autoload.php';

/**
 * Read the configuration
 */
$config = new Config(array_merge_recursive(
    require_once APP_PATH . "/config/config.php",
    require_once APP_PATH . "/config/config-local.php",
));

/**
 * Read auto-loader
 */
require_once ROOT_PATH . '/common/config/loader.php';
require_once APP_PATH . "/config/loader.php";

/**
 * Read services
 */
require_once ROOT_PATH . '/common/config/services.php';
require_once APP_PATH . "/config/services.php";
require_once APP_PATH . "/config/assets.php";

/**
 * Handle the request
 */
$application = new Application($di);
new Whoops\Provider\Phalcon\WhoopsServiceProvider($di);

$response = $application->handle($_SERVER['REQUEST_URI']);

$response->send();

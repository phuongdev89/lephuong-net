<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Phalcon\DevTools\Bootstrap;

/**
 * @const PTOOLS_IP Allowed IP for access.
 *        Phalcon Developers Tools can only be used in local machine, however
 *        you can set this to allow certain IP address.
 *
 *        For example:
 *          192.168.0.1 or SUBNET 192., 10.0.2., 86.84.124.
 *        For docker or dynamic IPs:
 *          $_SERVER['REMOTE_ADDR']
 */
defined('PTOOLS_IP') || define('PTOOLS_IP', '192.168.');
defined('BASE_PATH') || define('BASE_PATH', dirname(dirname(__FILE__)));
defined('ROOT_PATH') || define('ROOT_PATH', BASE_PATH);

/**
 * @const ENV_PRODUCTION Application production stage.
 */
defined('ENV_PRODUCTION') || define('ENV_PRODUCTION', 'production');

/**
 * @const ENV_STAGING Application staging stage.
 */
defined('ENV_STAGING') || define('ENV_STAGING', 'staging');

/**
 * @const ENV_DEVELOPMENT Application development stage.
 */
defined('ENV_DEVELOPMENT') || define('ENV_DEVELOPMENT', 'development');

/**
 * @const ENV_TESTING Application test stage.
 */
defined('ENV_TESTING') || define('ENV_TESTING', 'testing');

/**
 * @const APPLICATION_ENV Current application stage.
 */
defined('APPLICATION_ENV') || define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: ENV_DEVELOPMENT);

// ---------------------------- DO NOT EDIT BELOW ------------------------------

/**
 * @const PTOOLSPATH The path to the Phalcon Developers Tools.
 */
defined('PTOOLSPATH') || define('PTOOLSPATH', __DIR__ . '/../../vendor/phalcon/devtools');


/**
 * @psalm-suppress MissingFile
 */
include PTOOLSPATH . '/bootstrap/autoload.php';

/**
 * @psalm-suppress UndefinedConstant
 */
$bootstrap = new Bootstrap([
    'ptools_path' => PTOOLSPATH,
    'ptools_ip' => PTOOLS_IP,
    'base_path' => BASE_PATH,
]);

if (APPLICATION_ENV === ENV_TESTING) {
    return $bootstrap->run();
} else {
    echo $bootstrap->run();
}

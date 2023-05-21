<?php
/**
 * Created by Le Phuong.
 * @file     assets.php
 * @project  lephuong-net
 * @author   Phuong Dev <phuongdev89@gmail.com>
 * @datetime 5/21/2023 11:24 PM
 *
 * @see      https://docs.phalcon.io/4.0/en/assets#output
 * @var FactoryDefault $di
 * @var Manager $manager
 */

use Phalcon\Assets\Manager;
use Phalcon\Di\FactoryDefault;

$manager = $di->getShared('assets');

/**
 * header css & js
 */
$headerCollection = $manager->collection('header');
$headerCollection->addCss('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');
$headerCollection->addCss('/css/app.css', null, true, [], PHALCON_ENV == 'dev' ? time() : null);
$headerCollection->addCss('/css/custom.css', null, true, [], PHALCON_ENV == 'dev' ? time() : null);

/**
 * footer js
 */
$footerCollection = $manager->collection('footer');
$footerCollection->addJs('/js/app.js', null, true, [], PHALCON_ENV == 'dev' ? time() : null);

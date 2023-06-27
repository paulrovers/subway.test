<?php

use Symfony\Component\Dotenv\Dotenv;

ob_start();
ini_set('session.cookie_lifetime', 7200);
session_set_cookie_params(7200);
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('date.timezone', 'Europe/Berlin');

/**
 * Composer
 */
require '../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load('../.env');

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();
require('../App/Routes.php');

$ControllerObject=$router->dispatch($_SERVER['QUERY_STRING']);

$strBufferedContent = ob_get_contents();
ob_end_clean();

//$output = new Core\Output($_SERVER['QUERY_STRING']);

$ControllerObject->LoadTemplate($strBufferedContent,$ControllerObject);

?>
<?php
ob_start();
ini_set('session.cookie_lifetime', 7200);

/**
* Load jenda classes
*/
spl_autoload_register(function ($class_name) {
	if(file_exists('../Classes/'.$class_name . '.php')){
		require('../Classes/'.$class_name . '.php');
	}
});

/**
 * All Configuration
 */
require('../App/Config.php');

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(7200);
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('date.timezone', 'Europe/Berlin');

/**
 * Composer
 */
require '../vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();
require('../App/Routes.php');
require('../App/Redirects.php');
$router->redirect($_SERVER['QUERY_STRING']);


$ControllerObject=$router->dispatch($_SERVER['QUERY_STRING']);

$strBufferedContent = ob_get_contents();
ob_end_clean();

$output = new Core\Output($_SERVER['QUERY_STRING']);

$output->Send($strBufferedContent,$ControllerObject);

?>
<?php 
/**
 * Ziemes
 * 
 * This is just a test framework
 * 
 * @package Joseagd
 */

// Configure error level
error_reporting (E_ALL); 
ini_set ('display_errors', 1);


// Define base constants
define ('APP_DIR', __DIR__);


 
// Composer autoload
$loader = require_once __DIR__ . '/vendor/autoload.php';


// Requirements
use Ziemes\Framework\Framework;
use Ziemes\Framework\Controllers\ErrorController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Finder;
use HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;


// Search for routes
$finder = new Finder ();
$finder->files ()->in (__DIR__ . '/src')->name ('routes.php');

$routes = new RouteCollection ();
foreach ($finder as $file) {
    include $file;
}


// Events
$dispatcher = new EventDispatcher ();


// Add controller to handle error request
$dispatcher->addSubscriber (new ExceptionListener ('Ziemes\\Controllers\\ErrorController::indexAction'));


// Create request
$request = Request::createFromGlobals ();


// Create framework
$framework = new Framework ($dispatcher, $routes);


// Get response
$response = $framework->handle ($request);



// Send response
$response->send ();

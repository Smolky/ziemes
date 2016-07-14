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


// Requiriments
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Routing\Exception\ResourceNotFoundException;

use Symfony\Component\Finder\Finder;


// Search for routes
$finder = new Finder ();
$finder->files ()->in (__DIR__ . '/src')->name ('routes.php');

$routes = new RouteCollection ();
foreach ($finder as $file) {
    include $file;
}




// Create request
$request = Request::createFromGlobals ();


// Determine controller
$context = new RequestContext ();
$context->fromRequest ($request);
$matcher = new UrlMatcher ($routes, $context);


// Determine the controller
try {
    
    // Get 
    $attributes = $matcher->match ($request->getPathInfo ());
    
    
    // Run the delegated method
    // @todo
    $controller = new $attributes['_controller'] ();
    $response = $controller->execute ($attributes);

    

// No route can be found for this request
} catch (ResourceNotFoundException $e) {
    $response = new Response ('Not Found', 404);

// Another bad thing happers
} catch (Exception $e) {
    $response = new Response ('An error occurred ' . $e->getMessage (), 500);
}



// Send response
$response->send ();

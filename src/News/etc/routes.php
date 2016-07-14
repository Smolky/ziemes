<?php

/**
 *
 * @author José Antonio García Díaz
 */

use Symfony\Component\Routing\Route;


// Add route
$routes->add ('/', new Route ('/{name}', array ('_controller' => '\Ziemes\News\Controllers\Index', 'name' => 'no-one')));


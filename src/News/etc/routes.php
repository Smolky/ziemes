<?php

/**
 *
 * @author Jos� Antonio Garc�a D�az
 */

use Symfony\Component\Routing\Route;


// Add route
$routes->add ('/', new Route ('/{name}', array ('_controller' => '\Ziemes\News\Controllers\Index', 'name' => 'no-one')));


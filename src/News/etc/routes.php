<?php

/**
 *
 * @author José Antonio García Díaz
 */

namespace Ziemes\News\Controllers;
 
use Symfony\Component\Routing\Route;


// Add route
// For list
$routes->add ('route.news.index', new Route ('/news/{page}', 
    ['_controller' => __NAMESPACE__ . '\Index', 'page' => 1], 
    ['page' => '[0-9]+']
));

// For detail
$routes->add ('route.news.detail', new Route ('/news/{id}/{slug}', 
    ['_controller' => __NAMESPACE__ . '\Detail'], 
    ['id' => '[0-9]+']
));


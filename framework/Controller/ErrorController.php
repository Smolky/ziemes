<?php
/**
 *
 * @author José Antonio García Díaz
 */
 
namespace Ziemes\Framework\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\FlattenException;


/**
 * ErrorController
 *
 * @package Ziemes
 */
class ErrorController extends AbstractController {

    /**
     * indexAction
     *
     * @package Ziemes
     */
    public function indexAction (FlattenException $exception) {
        return new Response ('O.O', $exception->getStatusCode());
    }

}
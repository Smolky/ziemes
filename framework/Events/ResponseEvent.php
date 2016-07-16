<?php 
/**
 * Ziemes
 * 
 * This is just a test framework
 * 
 * @package Joseagd
 */

namespace Ziemes\Framework\Events;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\Event;


/**
 * ResponseEvent
 *
 * @package Ziemes
 */
class ResponseEvent extends Event
{
    /** @var Request $_request */
    private $_request;
    
    
    /** @var Response $_response */
    private $_response;

    
    /**
     * __construct
     *
     * @param Request $request
     * @param Response $response
     *
     * @package Ziemes
     */
    public function __construct (Response $response, Request $request) {
        $this->_response = $response;
        $this->_request = $request;
    }

    
    /**
     * getResponse
     *
     * Returns the response 
     *
     * @return Response
     *
     * @package Ziemes
     */
    public function getResponse () {
        return $this->_response;
    }
    
    
    /**
     * getRequest
     *
     * Returns the request 
     *
     * @return Request
     *
     * @package Ziemes
     */
    public function getRequest () {
        return $this->_request;
    }
}
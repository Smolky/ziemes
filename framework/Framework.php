<?php
/**
 *
 * @author José Antonio García Díaz
 */
namespace Ziemes\Framework;

use Symfony\Component\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RouteCollection;

use Ziemes\Framework\Events\ResponseEvent;


/**
 * Framework
 *
 * @package Ziemes
 */
class Framework extends HttpKernel\HttpKernel {

    /** @var Dispatacher */
    protected $_dispatcher;
    
    
    /** @var Routes */
    protected $_routes;
    
    
    /**
     * __construct
     *
     * @package Ziemes
     */
    public function __construct (EventDispatcher $dispatcher, RouteCollection $routes) {
        $this->_dispatcher = $dispatcher;
        $this->_routes = $routes;
    }
    

    /**
     * handle
     *
     * @param Request $request
     * @param int $routes
     * @param $catch
     *
     * @return Response
     *
     * @package Ziemes
     */
    
    public function handle (Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true) {
    
        // Determine controller
        $context = new RequestContext ();
        $context->fromRequest ($request);
        $matcher = new UrlMatcher ($this->_routes, $context);
        
        
        // Determine the controller
        try {
            
            // Get 
            $attributes = $matcher->match ($request->getPathInfo ());
            
            
            // Run the delegated method
            $controller = new $attributes['_controller'] ();
            $response = $controller->execute ($attributes);

            

        // No route can be found for this request
        } catch (ResourceNotFoundException $e) {
            $response = new Response ('Not Found', 404);

        // Another bad thing happers
        } catch (Exception $e) {
            $response = new Response ('An error occurred ' . $e->getMessage (), 500);
        }
        
        
        // Dispatch the response
        $this->_dispatcher->dispatch ('response', new ResponseEvent ($response, $request));
        
        
        // Return response
        return $response;
    
    }

}
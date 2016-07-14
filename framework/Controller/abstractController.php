<?php
/**
 *
 * @author José Antonio García Díaz
 */
namespace Ziemes\Framework\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use League\Plates\Template\Template;
use League\Plates\Engine;



/**
 * AbstractController 
 *
 * @package Ziemes
 */
 
abstract class AbstractController {

    /** @var Request */
    protected $_request;
    
    
    /** @var Response */
    protected $_response;
    
    
    /** @var Engine **/
    private $_templatesEngine;
    
    
    /**
     * index
     * 
     * @package Ziemes
     */
    abstract function execute () ;
    
    
    /**
     * getRequest
     *
     * @return Request
     * 
     * @package Ziemes
     */
    protected function getRequest () {
        return $this->_request;
    }
    
    
    /**
     * getTemplate
     *
     * @param String $template
     *
     * @return Template
     * 
     * @package Ziemes
     */
    protected function getTemplate ($template) {
        return new Template ($this->getTemplatesEngine (), $template);
    }
    
    
    /**
     * setResponse
     *
     * @param String $html String that contains the response
     * 
     * @package Ziemes
     */
    
    protected function setResponse ($html) {
        return new Response ($html);
    }
    
    
    /**
     * getTemplatesEngine
     *
     * @return Engine
     * 
     * @package Ziemes
     */
    private function getTemplatesEngine () {
    
        // Load!
        if ( ! $this->_templatesEngine) {
            // Get URL for the real controller
            $reflection = new \ReflectionClass ($this);
            
            $parts = explode ('/', dirname ($reflection->getFilename ()));
            array_pop ($parts);
            $url = implode ('/', $parts);
        
            
            // Reference templates
            $this->_templatesEngine = new Engine ($url . '/Templates', 'phtml');
        }
        
        // Returne the engine
        return $this->_templatesEngine;
    
    }    

}

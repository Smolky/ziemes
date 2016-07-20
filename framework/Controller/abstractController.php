<?php
/**
 *
 * @author José Antonio García Díaz
 */
namespace Ziemes\Framework\Controller;

use Pimple\Container;

use Symfony\Component\Routing\Generator\UrlGenerator;
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
    
    
    /** @var Container */
    protected $_container;
    
    
    /** @var Engine **/
    private $_templatesEngine;
    
    
    
    /**
     * __construct
     *
     * @package Ziemes
     */
    public function __construct (Container $container) {
        $this->_container = $container;
    }
    
    
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
    
        // Retrieve template engine
        $engine = $this->getTemplatesEngine ();
        
        
        // Create template
        $tpl = new Template ($this->getTemplatesEngine (), 'self::' . $template);
        
        
        // Assign global data to the template
        $tpl->_url_generator = $this->_container['routes.generator'];
        
        $tpl->request = $this->getRequest ();
        

        
    
    
        // Return template
        return $tpl;
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
        
            
            // Base urls
            $layours_dir = APP_DIR . '/src/Layouts';
            
            
            // Create engine
            $engine = new Engine ();

            
            // Configure to use only phtml files
            $engine->setFileExtension ('phtml');
            
            
            // Reference templates
            $engine->addFolder ('self', $url . '/Templates');
            $engine->addFolder ('layouts', $layours_dir);
            
            
            // Load!
            $this->_templatesEngine = $engine;
                        
            
        }
        
        // Returne the engine
        return $this->_templatesEngine;
    
    }    

}

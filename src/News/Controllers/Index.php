<?php 
/**
 *
 * @author José Antonio García Díaz
 */
namespace Ziemes\News\Controllers;

use Ziemes\Framework\Controller\AbstractController;


/**
 * Index
 *
 * @package joseagd\news
 */
class Index extends AbstractController {
    
    /**
     * execute
     *
     * @package joseagd\news
     */
    public function execute ($params=array ()) {
    
        // Retrieve template
        $template = $this->getTemplate ('index');
        
        
        // Assign data to the template
        $template->data (['name' => $params['name']]);
        
    
        // Return response
        return $this->setResponse ($template->render ());
    
    }

}
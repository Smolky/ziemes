<?php 
/**
 *
 * @author Jos� Antonio Garc�a D�az
 */
namespace Ziemes\News\Controllers;

use Ziemes\Framework\Controller\AbstractController;
use Ziemes\News\Model\Repositories\NewsRepository;


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
    
        // Retrieve all the news
        $news_repository = new NewsRepository ();
        $news_collection = $news_repository->findAll ();
        
    
        // Retrieve template
        $template = $this->getTemplate ('index');
        
        
        // Assign data to the template
        $template->data (['news_collection' => $news_collection]);
        
    
        // Return response
        return $this->setResponse ($template->render ());
    
    }

}
<?php 
/**
 *
 * @author José Antonio García Díaz
 */
namespace Ziemes\News\Controllers;

use Ziemes\Framework\Controller\AbstractController;
use Ziemes\News\Model\Repositories\NewsRepository;



/**
 * Index
 *
 * @package joseagd\news
 */
class Detail extends AbstractController {
    
    /**
     * execute
     *
     * @package joseagd\news
     */
    public function execute ($params=array ()) {
    
        // Retrieve the detail news
        $news_repository = new NewsRepository ();
        $news = $news_repository->findById ($params['id']);
        
        
        // Not found?! An 404 error must be thrown
        // @todo
        
        $parsedown = new \Parsedown ();
        
    
        // Retrieve template
        $template = $this->getTemplate ('detail');
        
        
        // Assign data to the template
        $template->data (['news' => $news, 'parsedown' => $parsedown]);
        
    
        // Return response
        return $this->setResponse ($template->render ());
    
    }

}
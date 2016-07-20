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
     * Usually the URLS to fetch an execute array has the following
     * schema: /id/slug
     *
     * It's possible that the SLUG doesn't fit with the ID and this
     * can cause 
     *
     * @package joseagd\news
     */
    public function execute ($params=array ()) {
    
        // Retrieve the detail news
        $news_repository = new NewsRepository ();
        $news = $news_repository->findById ($params['id']);
        
        
        // Not found?! An 404 error must be thrown
        // @todo
        
        
        // Has a different slug? Redirect!
        // @todo
        
        
        // Retrieve a markdown parser
        $parsedown = new \Parsedown ();
        
    
        // Retrieve template
        $template = $this->getTemplate ('detail');
        
        
        // Assign data to the template
        $template->data (['news' => $news, 'parsedown' => $parsedown]);
        
    
        // Return response
        return $this->setResponse ($template->render ());
    
    }

}
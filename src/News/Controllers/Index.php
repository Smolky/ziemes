<?php 
/**
 *
 * @author José Antonio García Díaz
 */
namespace Ziemes\News\Controllers;

use Pimple\Container;

use Ziemes\Framework\Controller\AbstractController;
use Ziemes\News\Model\Repositories\NewsRepository;
use Ziemes\News\Model\Repositories\CategoriesRepository;


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
        
        
        // Retrieve all the categories
        $categories_repository = new CategoriesRepository ();
        $categories_collection = $categories_repository->findAll ();
        
    
        // Retrieve template
        $template = $this->getTemplate ('index');
        
        
        // Assign data to the template
        $template->data ([
            'news_collection' => $news_collection,
            'categories_collection' => $categories_collection
        ]);
        
    
        // Return response
        return $this->setResponse ($template->render ());
    
    }

}
<?php

/**
 * @author José Antonio García Díaz
 */
 
namespace Ziemes\News\Model;


/**
 * News
 *
 * This entity represents an news publication
 *
 * @package Ziemes
 */
class News {

    /** @var $id */
    protected $id;
    
    /** @var created_at */
    protected $created_at;
    
    /** @var updated_at */
    protected $updated_at;

    /** @var String */
    protected $title;
    
    /** @var String */
    protected $content;
    
    /** @var Array */
    protected $categories = array ();
    
    /** @var Array */
    protected $tags = array ();

    
    /**
     * __construct
     *
     * @package Ziemes
     */
    public function __construct () {
    }
    
    
    /**
     * getId
     *
     * Gets the ID of the news
     *
     * @return int
     *
     * @package Ziemes
     */
    public function getId () {
        return $this->id;
    }
    
    
    /**
     * setId
     *
     * Sets the ID of the news
     *
     * @param int $id
     *
     * @package Ziemes
     */
    public function setId ($id) {
        $this->id = $id;
    }

    
    
    /**
     * getCreatedAt
     *
     * Gets when the news was created
     *
     * @return Timestamp
     *
     * @package Ziemes
     */
    public function getCreatedAt () {
        return $this->created_at;
    }
    
    
    /**
     * getUpdatedAt
     *
     * Gets when the news was created
     *
     * @return Timestamp
     *
     * @package Ziemes
     */
    public function getUpdatedAt () {
        return $this->updated_at;
    }

    
    /**
     * getSlug
     *
     * Gets the slug of the news
     *
     * @return String
     *
     * @package Ziemes
     */
    public function getSlug () {
        return $this->slug;
    }
    
    
    /**
     * setSlug
     *
     * Sets the slug of the news
     *
     * @param String $title
     *
     * @package Ziemes
     */
    public function setSlug ($slug) {
        $this->slug = $slug;
    }
    
    
    /**
     * getLink
     *
     * Gets an link
     *
     * @return String
     *
     * @package Ziemes
     */
    public function getLink () {
        return 'news/' . $this->getId () . '/' . $this->getSlug ();
    }
    
    
    /**
     * getTitle
     *
     * Gets the title of the news
     *
     * @return String
     *
     * @package Ziemes
     */
    public function getTitle () {
        return $this->title;
    }
    
    
    /**
     * setTitle
     *
     * Sets the title of the news
     *
     * @param String $title
     *
     * @package Ziemes
     */
    public function setTitle ($title) {
        $this->title = $title;
    }    
    
    
    /**
     * getContent
     *
     * Gets the content of the news
     *
     * @return String
     *
     * @package Ziemes
     */    
    public function getContent () {
        return $this->content;
    }
    
    
    /**
     * setContent
     *
     * Sets the title of the news
     *
     * @param String $title
     *
     * @package Ziemes
     */
    public function setContent ($content) {
        $this->content = $content;
    }      
    
    
    /**
     * getCategories
     *
     * Gets the categories attached to the news
     *
     * @return Array
     *
     * @package Ziemes
     */
    public function getCategories () {
        return $this->categories;
    }
    
    
    /**
     * setCategories
     *
     * Sets the categories attached to the news
     *
     * @param Array $categories
     *
     * @package Ziemes
     */
    public function setCategories ($categories) {
        $this->categories = $categories;
    }
    
    
    /**
     * hasCategories
     *
     * Determines if the news has attached categories
     *
     * @return Boolean
     *
     * @package Ziemes
     */        
    public function hasCategories () {
        return count ($this->categories) > 0;
    }
    
    
    /**
     * getTags
     *
     * Gets the tags attached to the news
     *
     * @return Array
     *
     * @package Ziemes
     */    
    public function getTags () {
        return $this->tags;
    }

    
    
    /**
     * setTags
     *
     * Sets the tags attached to the news
     *
     * @param Array $tags
     *
     * @package Ziemes
     */
    public function setTags ($tags) {
        $this->tags = $tags;
    }   
    
    
    /**
     * hasTags
     *
     * Determines if the news has attached tags
     *
     * @return Boolean
     *
     * @package Ziemes
     */ 
    public function hasTags () {
        return count ($this->tags) > 0;
    }

}
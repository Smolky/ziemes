<?php

/**
 * @author José Antonio García Díaz
 */
namespace Ziemes\News\Model;


/**
 * Category
 *
 * This entity represents a news category
 *
 * @package Ziemes
 */
class Category {

    /** @var $id */
    protected $id;
    
    /** @var created_at */
    protected $created_at;
    
    /** @var updated_at */
    protected $updated_at;

    /** @var String */
    protected $name;
    
    
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
     * Gets the ID of the category
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
     * Gets when the category was created
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
     * Gets when the category was created
     *
     * @return Timestamp
     *
     * @package Ziemes
     */
    public function getUpdatedAt () {
        return $this->updated_at;
    }

    
    
    /**
     * getName
     *
     * Gets the name of the category
     *
     * @return String
     *
     * @package Ziemes
     */
    public function getName () {
        return $this->name;
    }
    
    
    /**
     * setName
     *
     * Sets the name of the category
     *
     * @param String $name
     *
     * @package Ziemes
     */
    public function setName ($name) {
        $this->name = $name;
    }
}
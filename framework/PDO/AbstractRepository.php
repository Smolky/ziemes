<?php 

/**
 * @author José Antonio García Díaz
 */
namespace Ziemes\Framework\PDO;

/**
 * AbstractRepository
 *
 * This class is used to provide a default implementation
 * for all the repositories for your custom models
 *
 * The responsibility for this kind of objects 
 * if to generated the needed queries for fetching
 * the database and delegate in an DataMapper to fetch
 * the data
 * 
 *
 * @package Ziemes
 */
abstract class AbstractRepository {

    /** @var entity **/
    protected $entity = '';
    

    /** @var table */
    protected $table = '';
    
    
    /** @var DataMapper */
    protected $data_mapper;

    
    
    /**
     * __construct
     *
     * @package Ziemes
     */
    public function __construct () {
    
        // Determine the table name
        $entity = new $this->entity;
        if (isset ($entity->table)) {
            $table_name = $entity->table;
            
        } else {
            $parts = explode ('\\', $this->entity);
            $table_name = strtolower (end ($parts));
        }
        
        $this->table = $table_name;
        
        
        
        // Create the data mapper
        $this->data_mapper = new DataMapper ();
    }
    
    
    /**
     * findById
     *
     * Find one item by his primary key
     *
     * @param int $id
     *
     * @package Ziemes
     */
    public function findById ($id) {
    
        // Create the basic query
        $sql = "SELECT `$this->table`.* FROM `$this->table` WHERE `$this->table`.id = :id";
        
        
        // Return result
        $items = $this->data_mapper->map ($this->entity, $sql, ['id' => $id]);
        return reset ($items);
    
    }
    
    
    /**
     * findAll
     *
     * Find all items for the repository
     *
     * @package Ziemes
     */
    public function findAll ($page=1, $offset=PHP_INT_MAX) {
    
        // Create the basic query
        $sql = "SELECT `$this->table`.* FROM `$this->table` LIMIT :page, :offset";
        
        
        // Return items
        return $this->data_mapper->map ($this->entity, $sql, ['page' => $offset * ($page - 1), 'offset' => $offset]);
    }

}
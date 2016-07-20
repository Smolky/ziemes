<?php

/**
 * @author José Antonio García Díaz
 */
namespace Ziemes\Framework\PDO;

/**
 * DataMapper
 *
 * This class is used to map the objects
 * with his database representation
 *
 * A Data Mapper, is a Data Access Layer that performs 
 * bidirectional transfer of data between a persistent 
 * data store (often a relational database) and an in memory 
 * data representation (the domain layer). 
 * 
 * The goal of the pattern is to keep the in memory 
 * representation and the persistent data store independent 
 * of each other and the data mapper itself. 
 *
 * The layer is composed of one or more mappers 
 * (or Data Access Objects), performing the data transfer. 
 *
 * Mapper implementations vary in scope. 
 *
 * Generic mappers will handle many different domain entity 
 * types, dedicated mappers will handle one or a few.
 * 
 * The key point of this pattern is, unlike Active Record pattern, 
 * the data model follows Single Responsibility Principle.
 *
 * @package Ziemes
 */
class DataMapper {

    protected $pdo;

    /** @var PDO */
    public function __construct () {
    
        // Create PDO
        // @temp
        $host = 'localhost';
        $db = 'ziemes';
        $user = 'root';
        $pass = 'nsseaplp';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new \PDO ($dsn, $user, $pass, $opt);    

    }
    
    
    /**
     * map
     *
     * @param String $entity
     * @param String $sql
     * @param Array $params
     *
     * @return Array
     *
     * @package Ziemes
     */
    public function map ($entity, $sql, $params=array ()) {
    
        // Run query
        $query = $this->pdo->prepare ($sql);
        $query->execute ($params);

        
        // Init vars
        $items = [];
        
        
        // Get all available methods that can be mapped
        $available_methods = get_class_methods ($entity);
        

        // Result
        $raw_result = $query->fetchAll ();
        
        
        
        // Get all items
        if ($raw_result) foreach ($raw_result as $entity_raw_data) {
        
            // Create object
            $entity = new $entity ();
            
            
            // Get all raw data
            foreach ($entity_raw_data as $key => $value) {
            
                $method = 'set' . ucfirst ($key);
                if (in_array ($method, $available_methods)) {
                    call_user_func_array ([$entity, $method], [$value]); 
                }
            }
            
            $items[] = $entity;
        
        }
        
        
        // Return response
        return $items;
        
    
    }


}
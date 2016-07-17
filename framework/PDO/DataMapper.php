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
 * @package Ziemes
 */
class DataMapper {

    /** @var PDO */
    public function __construct () {

    }
    
    
    /**
     * map
     *
     * @param String $entity
     * @param Array $entities_raw_data_collection
     *
     * @return Array
     *
     * @package Ziemes
     */
    public function map ($entity, $entities_raw_data_collection) {
    
        // Init vars
        $items = [];
        
        
        // Get all available methods that can be mapped
        $available_methods = get_class_methods ($entity);
        
        
        // Get all items
        foreach ($entities_raw_data_collection as $entity_raw_data) {
        
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
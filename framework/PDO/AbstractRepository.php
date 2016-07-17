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
 * 
 *
 * @package Ziemes
 */
abstract class AbstractRepository {

    /** @var table */
    protected $table = '';
    
    
    /**
     * __construct
     *
     * @package Ziemes
     */
    public function __construct () {
    
        // Determine the table name
        if ( ! $this->table) {
            $parts = explode ('\\', $this->entity);
            $this->table = strtolower (end ($parts));
        }
        
        
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
        $sql = "
            SELECT 
                `" . $this->table . "`.* 
                
            FROM 
                `" . $this->table . "` 
                
            WHERE 
                `" . $this->table . '`.id = :id
        ';
        
        
        // Fetch items
        $query = $this->pdo->prepare ($sql);
        $query->execute (['id' => $id]);
        
        
        // Get data mapper
        $data_mapper = new DataMapper ();
        $items = $data_mapper->map ($this->entity, $query->fetchAll ());
        
        
        // Return items
        return reset ($items);
    
    }
    
    
    /**
     * findAll
     *
     * Find all items for the repository
     *
     * @package Ziemes
     */
    public function findAll () {
    
        // Create the basic query
        $sql = "SELECT `" . $this->table . "`.* FROM `" . $this->table . "`";
        
        
        // Fetch items
        $query = $this->pdo->prepare ($sql);
        $query->execute ();
        
        
        // Get data mapper
        $data_mapper = new DataMapper ();
        $items = $data_mapper->map ($this->entity, $query->fetchAll ());
        
        
        // Return items
        return $items;
    }

}
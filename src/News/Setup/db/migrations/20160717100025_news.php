<?php

use Phinx\Migration\AbstractMigration;

class News extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // Create the categories table
        $categories = $this->table('news_categories');
        $categories
            ->addColumn('createdat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created at'))
            ->addColumn('updatedat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Updated at'))
            ->addColumn('name', 'string', array ('comment' => 'Name of the category'))
            ->create()
        ;

                   
        // Create the tags table
        $tags = $this->table('news_tags');
        $tags
            ->addColumn('createdat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created at'))
            ->addColumn('updatedat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Updated at'))
            ->addColumn('name', 'string', array ('comment' => 'Name of the tag'))
            ->create()
        ;
        
    
        // Create the news table
        $news = $this->table('news');
        $news
            ->addColumn('createdat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created at'))
            ->addColumn('updatedat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Updated at'))
            ->addColumn('uid', 'char', array ('comment' => 'Public UID'))
            ->addColumn('title', 'string', array ('comment' => 'Title'))
            ->addColumn('slug', 'char', array ('comment' => 'Slug (url identifier)'))
            ->addColumn('content', 'text', array ('comment' => 'Content'))
            
            ->addIndex (array ('slug'), array ('unique' => true))
            
            ->create()
        ;
        
        
        // Create the news translations
        $news_translations = $this->table('news_translations');
        $news_translations
            ->addColumn('createdat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created at'))
            ->addColumn('updatedat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Updated at'))
            ->addColumn('news_id', 'integer', array('comment' => 'Locale'))
            ->addColumn('locale', 'char', array('comment' => 'Locale'))
            ->addColumn('code', 'char', array('comment' => 'Code'))
            ->addColumn('translation', 'text', array('comment' => 'Translation'))
            
            ->addIndex(array ('locale', 'code'), array ('unique' => true))
            
            ->addForeignKey('news_id', 'news', 'id', array ('delete' => 'CASCADE', 'update'=> 'NO_ACTION'))
            
            ->create()
        ;  
        
        
        
        // Create the many many relationships
        // Categories
        $news_nn_categories = $this->table('news_nn_news_categories');
        $news_nn_categories
            ->addColumn('createdat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created at'))
            ->addColumn('updatedat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Updated at'))
            ->addColumn('id1', 'integer', array ('comment' => 'News ID'))
            ->addColumn('id2', 'integer', array ('comment' => 'Category ID'))
           
            ->addForeignKey('id1', 'news', 'id', array ('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->addForeignKey('id2', 'news_categories', 'id', array ('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
           
            ->create() 
        ;
        
        
        // Tags
        $news_nn_tags = $this->table('news_nn_news_tags');
        $news_nn_tags
            ->addColumn('createdat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created at'))
            ->addColumn('updatedat', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'comment' => 'Updated at'))
            ->addColumn('id1', 'integer', array ('comment' => 'News ID'))
            ->addColumn('id2', 'integer', array ('comment' => 'Tag ID'))
           
            ->addForeignKey('id1', 'news', 'id', array ('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
            ->addForeignKey('id2', 'news_tags', 'id', array ('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
           
            ->create()
        ;

    }
}

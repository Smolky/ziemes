<?php

/**
 * @author José Antonio García Díaz
 */
namespace Ziemes\News\Model\Repositories;

use Ziemes\Framework\PDO\AbstractRepository;

/**
 * News
 *
 * This entity represents an news publication
 *
 * @package Ziemes
 */
class NewsRepository extends AbstractRepository {

    /** @var $entity */
    protected $entity = 'Ziemes\News\Model\News';


}
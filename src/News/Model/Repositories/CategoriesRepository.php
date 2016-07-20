<?php

/**
 * @author José Antonio García Díaz
 */
namespace Ziemes\News\Model\Repositories;

use Ziemes\Framework\PDO\AbstractRepository;

/**
 * News
 *
 * This entity represents an categories publication
 *
 * @package Ziemes
 */
class CategoriesRepository extends AbstractRepository {

    /** @var $entity */
    protected $entity = 'Ziemes\News\Model\Category';


}
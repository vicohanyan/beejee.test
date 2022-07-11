<?php

namespace core;

use core\db\Database;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use Exception;

class Model
{
    protected EntityManager $manager;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->manager = self::getManager();
    }

    /**
     * @throws Exception
     */
    public static function getManager(): EntityManager
    {
        $manager = Database::connection()::$entityManager;;
        return $manager;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws Exception
     */
    public function save(): void
    {
        $manager = self::getManager();
        $manager->persist($this);
        $manager->flush();
    }



    /**
     * @param string $className
     * @param int $id
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws Exception
     */
    public static function get(string $className, int $id): mixed
    {
        $manager = self::getManager();
        return $manager->find($className,$id);
    }

    /**
     * @param string $className
     * @param int $page
     * @param array $orders
     * @param int $limit
     * @return array
     * @throws Exception
     */
    public static function getAll(string $className, int $page = 0, array $orders = [],int $limit = APP_SETTINGS['ITEM_VIEW_LIMIT']): array
    {
        $manager = self::getManager();
        $repository = $manager->getRepository($className);
        $offset = 0;
        if(!empty($page)){
            $offset = $limit * ($page - 1);
        }
        return $repository->findBy([],orderBy: $orders, limit: $limit, offset: $offset);
    }

    /**
     * @param string $className
     * @param int $limit
     * @return int
     * @throws Exception
     */
    public static function getPageCount(string $className,int $limit = APP_SETTINGS['ITEM_VIEW_LIMIT']): int
    {
        $manager = self::getManager();
        $count = $manager->getRepository($className)->count([]);
        return ceil($count / $limit);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws Exception
     */
    public function remove(): void
    {
        $manager = self::getManager();
        $manager->remove($this);
        $manager->flush();
    }

}
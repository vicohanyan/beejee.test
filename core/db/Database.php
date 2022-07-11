<?php

namespace core\db;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Exception;

/**
 * Class Database
 * @package core\db
 */
class Database
{
    public static EntityManager $entityManager;
    private static Database $instance;

    /**
     * Z_PgSQL constructor
     * @throws Exception
     */
    private function __construct()
    {
        $filename = __DIR__ . '/../../config/database.ini';
        $config = parse_ini_file($filename, true);
        if (empty($config)) throw new Exception("Database config file not found");
        try {
            $configuration = ORMSetup::createAnnotationMetadataConfiguration(
                $paths = [__DIR__ . '/../../engine/Models'],
                $isDevMode = true
            );
            $connection_parameters = [
                'dbname'    => $config['NAME'],
                'user'      => $config['USERNAME'],
                'password'  => $config['PASSWORD'],
                'host'      => $config['HOST'],
                'driver'    => $config['DATABASE_DRIVER']
            ];
            self::$entityManager = EntityManager::create($connection_parameters, $configuration);
        } catch (Exception $e) {
            throw new Exception("Connection failure");
        }
    }

    /**
     * @return Database
     * @throws Exception
     */
    public static function connection(): Database
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
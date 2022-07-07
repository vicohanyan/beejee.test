<?php

namespace core\db;

use Exception;
use PDO;

/**
 * Class Database
 * @package core\db
 */

class Database
{
    private PDO $connection;
    private static Database $instance;

    /**
     * Z_PgSQL constructor
     * @throws Exception
     */
    private function __construct()
    {
        $filename = DOCUMENT_ROOT . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'database.ini';
        $config = parse_ini_file($filename, true);
        if(empty($config)) throw new Exception("Database config file not found");
        try{
            $this->connection = new PDO("{$config['DATABASE_TYPE']}:host='{$config['HOST']}';dbname='{$config['NAME']}'",$config['USERNAME'],$config['PASSWORD']);
        } catch(Exception $e){
            throw new Exception("Connection failure ");
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

    public function __destruct()
    {
        $this->connection = null;
    }
}
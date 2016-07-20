<?php
/**
 * Mysql Class
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jbyrne\System;

use Jbyrne\Interfaces;
use Symfony\Component\Yaml\Yaml;
use PDO;

class MySql implements Interfaces\Database
{
    private $host;
    private $dbName;
    private $user;
    private $pass;
    public $connection;

    public function __construct() 
    {
        $config = Yaml::parse(file_get_contents(__DIR__. '/../../config/database.yml'));

        if (!array_key_exists(ENV, $config)) {
            exit; //TODO create & throw exception.
        }

        $config = $config[ENV];
        $this->host = $config['host'];
        $this->dbName = $config['database'];
        $this->user = $config['username'];
        $this->pass = $config['password'];
        $this->connect();
    }

    public function connect()
    {
        $this->connection = new PDO("mysql:
            host=$this->host;
            dbname=$this->dbName", 
            $this->user, 
            $this->pass
        );

        return $this->connection;   
    }

    public function __destruct()
    {
        $this->db = null;
    }
}

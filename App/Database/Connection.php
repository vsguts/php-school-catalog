<?php

namespace App\Database;

use PDO;
use PDOException;
use App\Logger;

class Connection
{
    /**
     * @var PDO
     */
    protected $db;

    public function __construct($config)
    {
        $dbName = $config['db_name'];
        $host = $config['host'];
        $port = $config['port'];
        $dsn = "mysql:dbname=$dbName;host=$host;port=$port";
        $user = $config['username'];
        $password = $config['password'];

        try {
            $this->db = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            Logger::log("Connection does not work: {$e->getMessage()}", 'ERROR');
        };
    }

    public function getConnection()
    {
        return $this->db;
    }
}

<?php

namespace App\Database;

use App\Logger\FileLogger;
use App\Logger\Logger;
use App\Logger\LoggerInterface;
use App\Logger\LogLevel;
use PDO;
use PDOException;

class Connection
{
    /**
     * @var PDO
     */
    protected $db;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct($config)
    {
        $dbName = $config['db_name'];
        $host = $config['host'];
        $port = $config['port'];
        $dsn = "mysql:dbname=$dbName;host=$host;port=$port";
        $user = $config['username'];
        $password = $config['password'];
        $this->logger = new Logger(new FileLogger());

        try {
            $this->db = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            $this->logger->log(
                LogLevel::ERROR, $e->getMessage(),
                [
                    'dsn' => $dsn,
                    'user' => $user,
                    'password' => $password,
                    'exception' => $e
                ]
            );
            echo 'Connect does not work: ' . $e->getMessage();
        };
    }

    public function getConnection()
    {
        return $this->db;
    }
}

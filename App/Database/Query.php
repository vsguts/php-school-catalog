<?php

namespace App\Database;

use App\Config;
use App\Logger\FileLogger;
use App\Logger\Logger;
use App\Logger\LoggerInterface;
use App\Logger\LogLevel;
use PDO;

class Query
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(Connection $connection = null)
    {
        // FIXME
        if (!isset($connection)) {
            $connection = new Connection(Config::get('db'));
        }
        $this->logger = new Logger(new FileLogger());
        $this->db = $connection->getConnection();
    }

    public function getRow(string $query, array $params = [])
    {
        $query = $this->db->prepare($query);
        if ($query->execute($params) === true) {
            $this->logger->log(LogLevel::INFO, 'Successful query(getRow)', (array)$query);
        } else {
            $params[] = $query;
            $this->logger->log(LogLevel::ERROR, 'Incorrect query(getRow) or params', $params);
        }
        $query->execute($params);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getList(string $query, array $params = [])
    {
        $query = $this->db->prepare($query);
        if ($query->execute($params) === true) {
            $this->logger->log(LogLevel::INFO, 'Successful query(getList)', (array)$query);
        } else {
            $params[] = $query;
            $this->logger->log(LogLevel::ERROR, 'Incorrect query(getList) or params', $params);
        }
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(string $query, array $params = [])
    {
        $query = $this->db->prepare($query);
        if ($query->execute($params) === true) {
            $this->logger->log(LogLevel::INFO, 'Successful query(execute)', (array)$query);
        } else {
            $params[] = $query;
            $this->logger->log(LogLevel::ERROR, 'Incorrect query(execute) or params', $params);
        }
        $query->execute($params);
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
}

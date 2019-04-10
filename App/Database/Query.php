<?php

namespace App\Database;

use App\Config;
use App\Logger;
use App\LogLevel;
use PDO;

class Query
{
    /**
     * @var \PDO
     */
    protected $db;

    public function __construct(Connection $connection = null)
    {
        // FIXME
        if (!isset($connection)) {
            $connection = new Connection(Config::get('db'));
        }

        $this->db = $connection->getConnection();
    }

    public function getRow(string $query, array $params = [])
    {
        $query = $this->db->prepare($query);
        if ($query->execute($params) === true) {
            new Logger(LogLevel::INFO, 'Successful query(getRow)', (array)$query);
        } else {
            $params[] = $query;
            new Logger(LogLevel::ERROR, 'Incorrect query(getRow) or params', $params);
        }
        $query->execute($params);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getList(string $query, array $params = [])
    {
        $query = $this->db->prepare($query);
        if ($query->execute($params) === true) {
            new Logger(LogLevel::INFO, 'Successful query(getList)', (array)$query);
        } else {
            $params[] = $query;
            new Logger(LogLevel::ERROR, 'Incorrect query(getList) or params', $params);
        }
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(string $query, array $params = [])
    {
        $query = $this->db->prepare($query);
        if ($query->execute($params) === true) {
            new Logger(LogLevel::INFO, 'Successful query(execute)', (array)$query);
        } else {
            $params[] = $query;
            new Logger(LogLevel::ERROR, 'Incorrect query(execute) or params', $params);
        }
        $query->execute($params);
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
}

<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Logger\FileLogger;
use App\Logger\Logger;
use App\Logger\LoggerInterface;

abstract class BaseController
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(new FileLogger());
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}

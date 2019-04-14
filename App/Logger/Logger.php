<?php
declare(strict_types=1);

namespace App\Logger;

/**
 * Class Logger
 *
 * @package App\Logger
 */
class Logger implements LoggerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param string $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log(string $level, string $message, array $context = [])
    {
        $this->logger->log($level, $message, $context);
    }
}

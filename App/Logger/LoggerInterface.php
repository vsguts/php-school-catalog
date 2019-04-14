<?php
declare(strict_types=1);

namespace App\Logger;

/**
 * Interface LoggerInterface
 * @package App\Logger
 */
interface LoggerInterface
{
    /**
     * Logs with an arbitrary level.
     *
     * @param string $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log(string $level, string $message, array $context = []);
}

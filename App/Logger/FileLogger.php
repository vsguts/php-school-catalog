<?php
declare(strict_types=1);

namespace App\Logger;

/**
 * Class FileLogger
 *
 * @package App\Logger
 */
class FileLogger implements LoggerInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * FileLogger constructor.
     * @param string $path
     */
    public function __construct(string $path = __DIR__ . '/../../logs/')
    {
        $this->path = $path;
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
        if ($level !== LogLevel::ERROR && $level !== LogLevel::DEBUG && $level !== LogLevel::INFO) {
            throw new \RuntimeException('Incorrect type of logger-level!');
        }

        $filename = $this->path . date('d_m_Y_H') . '.txt';
        $msg = sprintf(
                "[%s] Level: '%s'. Message: '%s'",
                date('d.m.Y H:i:s'),
                $level,
                $message
            ) . PHP_EOL;

        if (!empty($context)) {
            $msg = $msg . ' Context: ' . json_encode($context) . PHP_EOL;
        }
        file_put_contents($filename, $msg, FILE_APPEND);
    }
}

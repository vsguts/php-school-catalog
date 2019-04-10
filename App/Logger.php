<?php
declare(strict_types=1);

namespace App;

use http\Exception\RuntimeException;

class Logger implements LoggerInterface
{
    protected $msg;
    protected $level;
    protected $context;

    public function __construct(string $level, string $msg, array $context = [])
    {
        $this->msg = $msg;
        $this->level = $level;
        $this->context = $context;
        $this->log($this->level, $this->msg, $this->context);
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
            throw new RuntimeException('Incorrect type of logger-level!');
        }

        $filename = __DIR__ . '/Logs/' . date('d_m_Y_H') . '.txt';
        $msg = '[' . date('d.m.Y H:i:s') .
            '] Level: ' . '\'' . strtoupper($level) .
            '\'. Message: \'' . $message . '\'' . PHP_EOL;
        if (!empty($context)) {
            $msg = $msg . ' Context: ' . json_encode($context) . PHP_EOL;
        }
        $fp = fopen($filename, 'a');
        fwrite($fp, $msg);
        fclose($fp);
    }
}

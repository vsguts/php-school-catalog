<?php

namespace App\Logger;

class Logger implements LoggerInterface
{
    /** @var string */
    private $folder = '../logs/';


    private function createLogDirectory(): void
    {
        if (!file_exists($this->folder) && !is_dir($this->folder)) {
            mkdir($this->folder);
        }
    }

    /**
     * @param string $message
     * @param string $errorType
     */
    public function log(string $message, $errorType = "INFO")
    {
        $this->createLogDirectory();

        file_put_contents($this->folder . date('Y_m_d_H') . '.log',
            sprintf("[%s] Level: `%s`. Message: `%s`", date('Y-m-d H:i:s'), $errorType, $message) . PHP_EOL,
            FILE_APPEND);
    }
}

<?php

namespace App;

class Logger implements LoggerInterface
{
    private $folder = '../logs/';

    public function log($message, $errorType = "INFO")
    {
        if (!file_exists($this->folder) && !is_dir($this->folder)) {
            mkdir($this->folder);
        }


        file_put_contents($this->folder . date('Y_m_d_H') . '.log',
            sprintf("[%s] Level: `%s`. Message: `%s`", date('Y-m-d H:i:s'), $errorType, $message) . PHP_EOL,
            FILE_APPEND);
    }
}

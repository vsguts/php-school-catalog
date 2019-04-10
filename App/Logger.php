<?php

namespace App;

class Logger implements LoggerInterface
{
    public function log($message, $errorType = "INFO")
    {
        $folder = '../logs/';

        if (!file_exists($folder) && !is_dir($folder)) {
            mkdir($folder);
        }


        file_put_contents($folder . date('Y_m_d_H') . '.log',
            sprintf("[%s] Level: `%s`. Message: `%s`", date('Y-m-d H:i:s'), $errorType, $message) . PHP_EOL,
            FILE_APPEND);
    }
}

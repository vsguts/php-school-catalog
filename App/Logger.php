<?php


namespace App;


class Logger implements LoggerInterface

{
    public function log($message, $errorType = "info")
    {
        $time = date('Y-m-d H:i:s');
        file_put_contents('../logs/' . date('Y_m_d_H') . '.log',  "[$time] Level: `$errorType`. Message: `$message`" . PHP_EOL,
            FILE_APPEND);
    }
}
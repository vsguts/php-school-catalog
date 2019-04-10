<?php

namespace App\Logger;

class Logger implements LoggerInterface
{
    public function log( string $message)
    {
        $path = '/app/docker/logs/' . date('Y_M_d_H') . '.log';

        $format = '[%s] Level: error. Message: "%s"';
        $newMessage = sprintf
        (
            $format,
            date('Y-m-d H_i_s'),
            $message
        );

        file_put_contents($path, $newMessage, FILE_APPEND);
    }
}
<?php

namespace App\Logger;

class Logger implements LoggerInterface
{
    public function log(string $message)
    {
        $format = '[%s] Level: error. Message: "%s"';
        $newMessage = sprintf
        (
            $format,
            date('Y-m-d H_i_s'),
            $message . PHP_EOL
        );

        file_put_contents($this->createFile(), $newMessage, FILE_APPEND);
    }

    private function createFile()
    {
        $path = '/app/docker/logs/' . date('Y_M_d_H') . '.log';
        return $path;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 15.04.2019
 * Time: 16:22
 */
namespace App;

class Logger implements LoggerInterface
{
    const LOGGER_PATH = __DIR__ . '/../logs/';

    public function log($level, $message)
    {
        $fileName = static::LOGGER_PATH . date('Y_m_d_H') . '.log';
        file_put_contents($fileName,
            '[' . date('Y-m-d H:i:s ') . "Level: ${level}. Message: ${message}" . PHP_EOL,
            FILE_APPEND);
    }
}
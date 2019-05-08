<?php

namespace App;


final class Logger implements LoggerInterface
{
    public static $instances = [];
    private $levels = ['DEBUG', 'INFO', 'WARN', 'ERROR', 'FATAL'];

    private static function getLogger() : Logger
    {
        $cls = static::class;
        if (!isset(static::$instances[$cls])) {
            static::$instances[$cls] = new static;
        }
        return static::$instances[$cls];
    }

    private function writeLog(string $message, string $level)
    {
        if (!in_array(strtoupper($level), $this->levels)) {
           throw new \Exception('Error level does not exist.');
        }

        $dateForLog = date('Y-m-d G:i:s');
        $dateForName = date('Y_m_d_G');
        $fileName = '../logs/' . $dateForName . '.log';
        file_put_contents($fileName,
            "[{$dateForLog}] Level: {$level}. Message: {$message} \n",
            FILE_APPEND
        );
    }


    public static function log(string $message, string $level)
    {
        $logger = static::getLogger();
        $logger->writeLog($message, $level);
    }
}
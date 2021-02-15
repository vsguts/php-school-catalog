<?php


namespace App\Logger;


Interface LoggerInterface

{
    public function log(string $log, $errorType = "INFO");
}
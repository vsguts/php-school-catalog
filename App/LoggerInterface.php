<?php


namespace App;


Interface LoggerInterface

{
    public function log($log, $errorType = "info");
}
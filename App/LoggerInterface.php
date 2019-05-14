<?php

namespace App;

interface LoggerInterface
{
    public static function log(string $message, string $level);
}
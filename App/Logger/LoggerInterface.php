<?php

namespace App\Logger;

interface LoggerInterface
{
    public function log(string $message);
}
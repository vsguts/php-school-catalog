<?php


namespace App;

require 'Logger.php';

class LoggerTest extends \PHPUnit\Framework\TestCase

{
    /** @var Logger */
    private $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger();
    }

    public function testLog()
    {
        $this->logger->log('test');
    }

}
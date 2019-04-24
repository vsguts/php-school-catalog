<?php


namespace Tests\App\Logger;

use App\Logger\Logger;

class LoggerTest extends \PHPUnit\Framework\TestCase

{
    /** @var Logger */
    private $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger();
    }

    public function testLog(): void
    {
        $this->logger->log('test');
    }
}

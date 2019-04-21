<?php
namespace App\Testing;

use App\Logger\Logger;

class LoggerTest extends \PHPUnit\Framework\TestCase
{
    private $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger();
    }

    protected function tearDown(): void
    {
        $this->logger = NULL;
    }

    public function testLog(string $message)
    {
        $file = '/app/docker/logs/' . date('Y_M_d_H') . '.log';

        $this->logger->log($message);

        $this->assertFileExists($file);
    }
}
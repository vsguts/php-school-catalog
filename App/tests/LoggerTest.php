<?php

use App\Logger;

class LoggerTest extends PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        Logger::log('test', 'INFO');
    }

    public function testFile()
    {
        $fileName = dirname(__FILE__) . '/../../logs/' . date('Y_m_d_G') . '.log';
        $this->assertFileExists($fileName);
    }
}
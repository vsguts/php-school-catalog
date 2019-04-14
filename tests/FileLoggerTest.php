<?php
declare(strict_types=1);

use App\Logger\FileLogger;
use App\Logger\LoggerInterface;
use App\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

class FileLoggerTest extends TestCase
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var string
     */
    private $path;

    public function setUp(): void
    {
        $this->path = __DIR__ . '/../logs/test/';
        if (!is_dir($this->path)) {
            mkdir($this->path, 777);
        }
        $this->logger = new FileLogger($this->path);
    }

    public function tearDown(): void
    {
        exec(sprintf("rm -rf %s", escapeshellarg($this->path)));
    }

    /**
     * @dataProvider provider
     * @param $lvl
     * @param $msg
     */
    public function testLog($lvl, $msg)
    {
        $filename = $this->path . date('d_m_Y_H') . '.txt';
        $this->logger->log($lvl, $msg);
        $this->assertFileExists($filename);
        $log = file_get_contents($filename);
        $this->assertEquals('[' . date('d.m.Y H:i:s') . '] Level: \'' . $lvl . '\'. Message: \'' . $msg . '\'' . PHP_EOL,
            $log);
    }

    public function provider()
    {
        return array(
            array(LogLevel::INFO, 'info message'),
            array(LogLevel::ERROR, 'error message'),
            array(LogLevel::DEBUG, 'debug message'),
        );
    }
}

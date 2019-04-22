<?php
declare(strict_types=1);

namespace Test;

use App\Controllers\IndexController;
use PHPUnit\Framework\TestCase;

/**
 * Class IndexControllerTest
 *
 * @package Test
 */
class IndexControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testIndex(): void
    {
        $class = new IndexController();
        $this->expectOutputString('I am action index');
        $class->index();
    }
}

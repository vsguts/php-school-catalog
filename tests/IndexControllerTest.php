<?php
declare(strict_types=1);

namespace Test;

use App\Controllers\IndexController;
use PHPUnit\Framework\TestCase;

class IndexControllerTest extends TestCase
{
    public function testIndex()
    {
        $class = new IndexController();
        $this->expectOutputString('I am action index');
        $class->index();
    }
}

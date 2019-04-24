<?php

namespace tests\App\Http;

use App\Http\Route;

//require __DIR__ . '/../../../App/Http/Route.php';

class RouteTest extends \PHPUnit\Framework\TestCase
{
    /** @object Route */
    private $route;

    private $class = 'sdcjsdndsj';

    private $action = 'sajkjcnsdajk';


    protected function setUp(): void
    {
        $this->route = new Route($this->class, $this->action);
    }

    public function testGetClass(): void
    {
        $this->assertEquals($this->action, $this->route->getClass());
    }

    public function testGetAction(): void
    {
        $this->assertEquals($this->class, $this->route-getAction());
    }

}
<?php

namespace App\Testing;

use App\Http\Route;

class RouteTest extends \PHPUnit\Framework\TestCase
{
    private $route;
    private $class = 'class';
    private $action = 'action';

    protected function setUp(): void
    {
        $this->route = new Route($this->class, $this->action);
    }

    protected function tearDown(): void
    {
        $this->route = NULL;
    }

    public function testGetClass()
    {
        $class = $this->route->getClass();
        $this->assertEquals($this->class, $class);
    }

    public function testGetAction()
    {
        $action = $this->route->getAction();
        $this->assertEquals($this->action, $action);
    }

}
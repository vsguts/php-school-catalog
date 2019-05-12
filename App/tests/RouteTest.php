<?php

use App\Http\Route;


class RouteTest extends PHPUnit\Framework\TestCase
{
    protected $route;

    /**
     * @dataProvider routesProvider
     */
    public function testGetClass($class, $action)
    {
        $this->route = new Route($class, $action);
        $this->assertSame($class, $this->route->getClass());
    }

    /**
     * @dataProvider routesProvider
     */
    public function testGetAction($class, $action)
    {
        $this->route = new Route($class, $action);
        $this->assertSame($action, $this->route->getAction());
    }

    public function routesProvider()
    {
        return [
            ['IndexController', 'index'],
            ['FormController', 'index'],
            ['FormController', 'view'],
            ['FormController', 'create'],
            ['FormController', 'delete'],
            ['FormController', 'update'],
        ];
    }

}
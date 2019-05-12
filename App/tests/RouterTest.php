<?php

use App\Http\{Router, RequestInterface};


class RouterTest extends PHPUnit\Framework\TestCase
{
    private $router;
    private $request;

    public function setUp(): void
    {
        $this->router = new Router;
    }

    public function tearDown(): void
    {
        $this->router = null;
    }

    /**
     * @dataProvider routesProvider
     */
    public function testAdd($method, $path, $class, $action)
    {
        $this->router->add($method, $path, $class, $action);
        $this->assertObjectHasAttribute('routes', $this->router);
    }

    public function testResolve()
    {
        $this->request = $this->getMockBuilder(RequestInterface::class)
            ->setMethods(['getMethod', 'getPath', 'getQueryParams', 'getPostData'])
            ->getMock();

        $this->request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET')
            );

        $this->request->expects($this->any())
            ->method('getPath')
            ->will($this->returnValue('/forms')
            );

        $this->router->add('get', '/forms', 'FormController', 'index');

        $this->assertIsObject($this->router->resolve($this->request));
    }

    public function routesProvider()
    {
        return [
            ['get', '/', 'IndexController', 'index'],
            ['get', '/forms', 'FormController', 'index'],
            ['get', '/forms/view', 'FormController', 'view'],
            ['post', '/forms/create', 'FormController', 'create'],
            ['get', '/forms/delete', 'FormController', 'delete'],
            ['post', '/forms/update', 'FormController', 'update'],
        ];
    }
}
<?php

namespace App;

use App\Http\RequestInterface;
use App\Http\RouteInterface;
use App\Http\RouterInterface;

class Application
{
    /**
     * @var RouterInterface
     */
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function handRequest(RequestInterface $request)
    {
        $route = $this->router->resolve($request);
        return $this->runControllerAction($route, $request);

    }

    protected function runControllerAction(RouteInterface $route, RequestInterface $request)
    {
        $params = $request->getQueryParams();
        $class = $route->getClass();
        $action = $route->getAction();

        $controller = new $class;

        return $controller->$action($params);

    }
}

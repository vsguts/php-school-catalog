<?php

namespace App\Http;

use App\Logger;
use App\Views\RedirectView;

class Router implements RouterInterface
{
    protected $routes = [];

    public function add(string $method, string $path, string $controller, string $action)
    {
        $method = strtoupper($method);

        $this->routes[$method][$path] = new Route($controller, $action);
    }

    public function resolve(RequestInterface $request) : RouteInterface
    {
        $method = $request->getMethod();
        $path = $request->getPath();

        if (!isset($this->routes[$method][$path])) {
            Logger::log(
                "Route not found. Path: {$path}, method: {$method}.",
                'ERROR'
            );
            $redirect = new RedirectView('/forms');
            $redirect->render();
        }

        return $this->routes[$method][$path];
    }
}

<?php

namespace App\Http;

use App\Logger\Logger;

class Router implements RouterInterface
{
    protected $routes = [];

    public function add(string $method, string $path, string $controller, string $action)
    {
        $method = strtoupper($method);

        $this->routes[$method][$path] = new Route($controller, $action);
    }

    public function resolve(RequestInterface $request): RouteInterface
    {
        try {
            $method = $request->getMethod();
            $path = $request->getPath();

            if (!isset($this->routes[$method][$path])) {
                throw new \Exception('Route not found');
            }

            return $this->routes[$method][$path];
        } catch (\Exception $e) {
            $log = new Logger();
            $log->log($e->getMessage());
        }
    }
}

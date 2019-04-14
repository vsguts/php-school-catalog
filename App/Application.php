<?php

namespace App;

use App\Http\RequestInterface;
use App\Http\RouteInterface;
use App\Http\RouterInterface;
use App\Logger\FileLogger;
use App\Logger\Logger;
use App\Logger\LoggerInterface;
use App\Logger\LogLevel;
use App\Views\ViewInterface;

class Application
{
    /**
     * @var RouterInterface
     */
    protected $router;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        $this->logger = new Logger(new FileLogger());
    }

    public function handleRequest(RequestInterface $request)
    {
        $route = $this->router->resolve($request);
        $controller = $this->resolveControllerClass($route);
        $action = $this->resolveControllerAction($route, $controller);

        $result = $this->runControllerAction($controller, $action, $request);
        $this->render($result);
    }

    protected function resolveControllerClass(RouteInterface $route)
    {
        $class = $route->getClass();

        if (!class_exists($class)) {
            $this->logger->log(LogLevel::ERROR, 'Controller class does not exists', (array)$route);
            throw new \Exception('Controller class does not exists');
        } else {
            $this->logger->log(LogLevel::INFO, 'Controller class exists', (array)$route);
        }

        return new $class;
    }

    protected function resolveControllerAction(RouteInterface $route, $controller)
    {
        $action = $route->getAction();

        if (!method_exists($controller, $action)) {
            $route = (array)$route;
            $route ['controller'] = $controller;
            $this->logger->log(LogLevel::ERROR, 'Action does not exists', $route);
            throw new \Exception('Action does not exists');
        }

        return $action;
    }

    protected function runControllerAction($controller, $action, RequestInterface $request)
    {
        $params = $request->getQueryParams();
        $postData = $request->getPostData();

        return $controller->$action($params, $postData);
    }

    protected function render($result)
    {
        if ($result instanceof ViewInterface) {
            $result->render();
        } elseif (is_string($result)) {
            echo $result;
        } else {
            $this->logger->log(LogLevel::ERROR, 'Unsuported type for render in Application', (array)$result);
            throw new \Exception('Unsuported type');
        }
    }
}

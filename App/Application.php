<?php

namespace App;

use App\Http\RequestInterface;
use App\Http\RouteInterface;
use App\Http\RouterInterface;
use App\Logger\Logger;
use App\Views\ViewInterface;

class Application
{
    /**
     * @var RouterInterface
     */
    protected $router;
    protected $logger;


    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        $this->logger = new Logger();
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
        try {
            $class = $route->getClass();

            if (!class_exists($class)) {
                throw new \Exception('Controller class does not exists');
            }

            return new $class;

        } catch (\Exception $e) {
            $this->logger->log($e->getMessage());
        }
    }

    protected function resolveControllerAction(RouteInterface $route, $controller)
    {
        try {
            $action = $route->getAction();

            if (!method_exists($controller, $action)) {
                throw new \Exception('Action does not exists');
            }

            return $action;

        } catch (\Exception $e) {
            $this->logger->log($e->getMessage());
        }
    }

    protected function runControllerAction($controller, $action, RequestInterface $request)
    {
        $params = $request->getQueryParams();
        $postData = $request->getPostData();

        return $controller->$action($params, $postData);
    }

    protected function render($result)
    {
        try {
            if ($result instanceof ViewInterface) {
                $result->render();
            } elseif (is_string($result)) {
                echo $result;
            } else {
                throw new \Exception('Unsuported type');
            }
        } catch (\Exception $e) {
            $this->logger->log($e->getMessage());
        }
    }
}

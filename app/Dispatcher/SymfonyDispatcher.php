<?php

namespace App\Dispatcher;

use FastRoute\Dispatcher;
use Penny\Dispatcher as BaseDispatcher;
use Penny\Exception\MethodNotAllowedException;
use Penny\Exception\RouteNotFoundException;
use Penny\Route\RouteInfo;

class SymfonyDispatcher extends BaseDispatcher
{
    /**
     *  @param mixed $request
     */
    public function __invoke($request)
    {
        $routeInfo = $this->router->dispatch($request->getMethod(), $request->getPathInfo());
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new RouteNotFoundException;
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new MethodNotAllowedException;
                break;
            case Dispatcher::FOUND:
                $controller = $this->container->get($routeInfo[1][0]);
                $eventName = sprintf('%s.%s', strtolower($routeInfo[1][0]), $routeInfo[1][1]);

                return new RouteInfo($eventName, [$controller, $routeInfo[1][1]], $routeInfo[2]);

                break;
            default:
                throw new \Exception(null, 500);
                break;
        }
    }
}

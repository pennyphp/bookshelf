<?php

namespace ClassicApp\Dispatcher;

use Penny\Exception\MethodNotAllowed;
use Penny\Exception\RouteNotFound;
use Symfony\Component\HttpFoundation\Request;

class SymfonyDispatcher
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function __invoke(Request $request)
    {
        $routeInfo = $this->router->dispatch($request->getMethod(), $request->getPathInfo());
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                throw new RouteNotFound;
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                throw new MethodNotAllowed;
                break;
            case \FastRoute\Dispatcher::FOUND:
                return $routeInfo;
                break;
            default:
                throw new \Exception(null, 500);
                break;
        }
    }
}
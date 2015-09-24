<?php
return [
    'event_manager' => \DI\decorate(function($eventManager, $container) {
        $eventManager->attach("ERROR_DISPATCH", [$container->get(\ClassicApp\EventListener\DispatcherExceptionListener::class), "onError"]);
        $eventManager->attach("*_error", [$container->get(\ClassicApp\EventListener\ExceptionListener::class), "onError"]);
        return $eventManager;
    }),
    \ClassicApp\EventListener\ExceptionListener::class => \DI\object(\ClassicApp\EventListener\ExceptionListener::class)
        ->constructor(\DI\get("template")),
    \ClassicApp\EventListener\DispatcherExceptionListener::class => \DI\object(\ClassicApp\EventListener\DispatcherExceptionListener::class)
        ->constructor(\DI\get("template")),
    'template' => \DI\object(\League\Plates\Engine::class)->constructor('./app/view/'),
    'router' => function () {
        return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['ClassicApp\Controller\IndexController', 'index']);
        });
    },
];

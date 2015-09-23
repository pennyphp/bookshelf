<?php
return [
    'event_manager' => \DI\decorate(function($eventManager, $container) {
        $eventManager->attach("ERROR_DISPATCH", [$container->get(\ClassicApp\EventListener\PageNotFound::class), "onError"]);

        return $eventManager;
    }),
    \ClassicApp\EventListener\PageNotFound::class => \DI\object(\ClassicApp\EventListener\PageNotFound::class)
        ->constructor(\DI\get("template")),
    'template' => \DI\object(\League\Plates\Engine::class)->constructor('./app/view/'),
    'router' => function () {
        return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['ClassicApp\Controller\IndexController', 'index']);
        });
    },
];

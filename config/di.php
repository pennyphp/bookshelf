<?php
return [
    'template' => \DI\object(\League\Plates\Engine::class)->constructor('./app/view/'),
    'router' => function () {
        return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['ClassicApp\Controller\IndexController', 'index']);
        });
    },
];

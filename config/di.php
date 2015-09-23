<?php
return [
    'event_manager' => \DI\decorate(function($eventManager, $container) {
        $template = $contaner->get('template');
        $eventManager->attach('ERROR_DISPATCH', function (\GianArb\Penny\Event\HttpFlowEvent $event) use ($template) {
            $e = $event->getException();

            $response = $event->getResponse()->withStatus($e->getCode());
            $event->setResponse($response);

            $response->getBody()->write($template->render("error/40x", [
                'title' => $e->getMessage(),
                'exception' => $e,
            ]));
        });

        return $eventManager;
    }),
    'template' => \DI\object(\League\Plates\Engine::class)->constructor('./app/view/'),
    'router' => function () {
        return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['ClassicApp\Controller\IndexController', 'index']);
        });
    },
];

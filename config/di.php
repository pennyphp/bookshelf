<?php
return [
    'event_manager' => \DI\decorate(function ($eventManager, $container) {
        $eventManager->attach('dispatch_error', [$container->get(\App\EventListener\DispatcherExceptionListener::class), 'onError']);
        $eventManager->attach('*', [$container->get(\App\EventListener\ExceptionListener::class), 'onError']);
        return $eventManager;
    }),
    \App\EventListener\ExceptionListener::class => \DI\object(\App\EventListener\ExceptionListener::class)
        ->constructor(\DI\get('template')),
    \App\EventListener\DispatcherExceptionListener::class => \DI\object(\App\EventListener\DispatcherExceptionListener::class)
        ->constructor(\DI\get('template')),
    'dispatcher' => \DI\factory(function (\DI\Container $c) {
        $dispatcher = new \App\Dispatcher\SymfonyDispatcher($c->get('router'));
        return $dispatcher;
    }),
    'session' => \DI\factory(function (\DI\Container $c) {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $session->start();
        return $session;
    }),
    'translator' => \DI\factory(function () {
        $translator = new \Symfony\Component\Translation\Translator('en_US', new \Symfony\Component\Translation\MessageSelector());
        $translator->addLoader('php', new \Symfony\Component\Translation\Loader\PhpFileLoader());
        $translator->addResource('php', './app/Resources/translator/en_US.php', 'en_US');
        $translator->addResource('php', './app/Resources/translator/it_IT.php', 'it_IT');
        return $translator;
    }),
    'template' => \DI\factory(function (\DI\Container $c) {
        $twigBridgeViews = __DIR__ . '/../vendor/symfony/twig-bridge/Resources/views/Form';
        $loader = new Twig_Loader_Filesystem([$twigBridgeViews, './app/Resources/view']);

        $twig = new Twig_Environment($loader, $c->get('parameters')['twig']['loader_options']);

        $twig->addGlobal('show_exception_backtrace', $c->get('parameters')['twig']['show_exception_backtrace']);
        $twig->addGlobal('session', $c->get('session'));
        $formEngine = new \Symfony\Bridge\Twig\Form\TwigRendererEngine(
            [
                'bootstrap_3_layout.html.twig',
            ]
        );
        $formEngine->setEnvironment($twig);

        $formExt = new \Symfony\Bridge\Twig\Extension\FormExtension(new \Symfony\Bridge\Twig\Form\TwigRenderer($formEngine));
        $twig->addExtension($formExt);

        $transExt = new \Symfony\Bridge\Twig\Extension\TranslationExtension($c->get('translator'));
        $twig->addExtension($transExt);
        return $twig;
    }),
    'router' => function () {
        return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['App\Controller\IndexController', 'index']);
            $r->addRoute('GET', '/book', ['App\Controller\BookController', 'index']);
            $r->addRoute('GET', '/book/new', ['App\Controller\BookController', 'create']);
            $r->addRoute('POST', '/book/new', ['App\Controller\BookController', 'create']);
        });
    },
    'redis' => \DI\factory(function(\DI\Container $c) {
        $redis = new Redis();
        $redis->connect($c->get('parameters')['redis']['host'], $c->get('parameters')['redis']['port']);
        return $redis;
    }),
    'doctrine.dbal' => \DI\factory(function (\DI\Container $c) {
        return Doctrine\DBAL\DriverManager::getConnection($c->get('parameters')['doctrine']['conn']);
    }),
    'doctrine.em' => \DI\factory(function (\DI\Container $c) {
        $cacheDriver = new \Doctrine\Common\Cache\RedisCache();
        $cacheDriver->setRedis($c->get('redis'));
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $c->get('parameters')['doctrine']['orm']['entityPaths'],
            $c->get('parameters')['doctrine']['orm']['devMode'],
            $c->get('parameters')['doctrine']['orm']['proxyDir'],
            $cacheDriver,
            false
        );
        $dbal = $c->get('doctrine.dbal');
        return \Doctrine\ORM\EntityManager::create($dbal, $config);
    }),
];

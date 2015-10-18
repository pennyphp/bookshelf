<?php
return [
    'parameters' => [
        'doctrine' => [
            'orm' => [
                'devMode' => false,
                'entityPaths' => [__DIR__ . '/../app/Entity'],
                'proxyDir' => './data/cache/doctrine'
            ],
            'conn' => [
                'driver' => 'pdo_mysql',
                'dbname' => $_SERVER['MYSQL_DATABASE'],
                'user' => $_SERVER['MYSQL_USERNAME'],
                'password' => $_SERVER['MYSQL_PASSWORD'],
                'host' => $_SERVER['MYSQL_HOST'],
            ]
        ]
    ],
];

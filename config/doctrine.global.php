<?php
return [
    'parameters' => [
        'doctrine' => [
            'orm' => [
                'devMode' => true,
                'entityPaths' => [__DIR__ . '/../app/Entity'],
                'proxyDir' => './data/cache/doctrine'
            ],
            'conn' => [
                'driver' => 'pdo_mysql',
                'dbname' => 'demoapp',
                'user' => 'root',
                'password' => 'mysupersecretrootpassword',
                'host' => 'mysql',
            ]
        ]
    ],
];
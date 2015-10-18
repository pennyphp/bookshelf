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
                'dbname' => isset($_SERVER['MYSQL_DATABASE']) ? $_SERVER['MYSQL_DATABASE'] : null,
                'user' => isset($_SERVER['MYSQL_USERNAME']) ? $_SERVER['MYSQL_USERNAME'] : null,
                'password' => isset($_SERVER['MYSQL_PASSWORD']) ? $_SERVER['MYSQL_PASSWORD'] : null ,
                'host' => isset($_SERVER['MYSQL_HOST']) ? $_SERVER['MYSQL_HOST'] : null,
            ]
        ]
    ],
];

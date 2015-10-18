<?php
return [
    'parameters' => [
        'redis' => [
            'host' => isset($_SERVER['REDIS_HOST']) ? $_SERVER['REDIS_HOST'] : null,
            'port' => isset($_SERVER['REDIS_PORT']) ? $_SERVER['REDIS_PORT'] : null
        ]
    ],
];

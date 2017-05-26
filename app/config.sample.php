<?php
use Wandu\Api\Http\Middlewares\AuthJwtToken;
use Wandu\Router\Middleware\Cors;

return [
    'env' => 'develop',
    'debug' => true,
    'timezone' => 'UTC',
    'caster' => [
        'casters' => [
            'datetime' => Wandu\Caster\Caster\CarbonCaster::class,
            'date' => Wandu\Caster\Caster\DateCaster::class,
            'time' => Wandu\Caster\Caster\TimeCaster::class,
        ],
    ],
    'database' => [
        'connections' => [
            'default' => [
                'driver'    => 'mysql',
                'host'      => 'localhost',
                'database'  => 'wandu',
                'username'  => 'root',
                'password'  => '',
                'charset'   => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix'    => 'dev_',
            ],
        ],
        'migrator' => [
            'connection' => 'default',
            'table' => 'migrations',
            'path' => 'migrations',
        ],
    ],
    'router' => [
        'middleware' => [
            Cors::class,
            AuthJwtToken::class,
        ],
    ],
    'session' => [
        'type' => 'file',
        'path' => 'cache/sessions',
    ],

    // for other service providers :-)
    'monolog' => [
        'monolog' => [
            'path' => 'storage/log/wandu.log',
        ],
    ],
    'neomerx' => [
        'cors-psr7' => [
            'server-origin' => 'http://localhost:8000', // == 'http://' . config('host')
            'allowed-origins' => ['http://allbus.dev' => true,],
            'allowed-methods' => ['GET' => true, 'POST' => true, 'PUT' => true, 'DELETE' => true, 'OPTIONS' => true],
            'allowed-headers' => ['X-Allbus-Key' => true,],
        ],
    ],
];

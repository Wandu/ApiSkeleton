<?php
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
    'session' => [
        'type' => 'file',
        'path' => 'cache/sessions',
    ],
    'log' => [
        'path' => null,
    ],
    'view' => [
        'path' => 'views',
        'cache' => 'cache/views',
    ],
];

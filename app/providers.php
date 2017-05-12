<?php
use Wandu\Api\ApplicationServiceProvider;
use Wandu\Caster\CasterServiceProvider;
use Wandu\Database\DatabaseServiceProvider;
use Wandu\Database\Migrator\MigratorServiceProvider;
use Wandu\DateTime\DateTimeServiceProvider;
use Wandu\DI\Providers\Monolog\MonologServiceProvider;
use Wandu\DI\Providers\Neomerx\CorsPsr7ServiceProvider;
use Wandu\Event\EventServiceProvider;
use Wandu\Http\HttpServiceProvider;
use Wandu\Q\QueueServiceProvider;
use Wandu\Router\RouterServiceProvider;

return [
    HttpServiceProvider::class,
    RouterServiceProvider::class,
    EventServiceProvider::class,
    DateTimeServiceProvider::class,
    MigratorServiceProvider::class,
    CasterServiceProvider::class,
    DatabaseServiceProvider::class,
    QueueServiceProvider::class,

    MonologServiceProvider::class,
    CorsPsr7ServiceProvider::class,
    
    ApplicationServiceProvider::class,
];

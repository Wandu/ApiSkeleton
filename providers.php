<?php
return [
    new Wandu\Service\Eloquent\EloquentServiceProvider(),
    new Wandu\Service\Monolog\MonologServiceProvider(),

    // if you want to use it, `composer require `guzzlehttp/guzzle` then remove comment 
    // new \Wandu\Service\GuzzleHttp\GuzzleServiceProvider(),

    new App\Domain\AppServiceProvider(),
];

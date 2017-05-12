<?php
namespace Wandu\Api\Http\Controllers;

use Wandu\Router\Router;

return function (Router $router) {
    $router->get('', HomeController::class);
    $router->prefix('auth/', function (Router $router) {
        $router->createRoute(['OPTIONS', 'POST'], 'login', AuthController::class, 'login');
    });
};

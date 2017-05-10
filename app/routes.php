<?php
namespace Wandu\Api\Http\Controllers;

use Wandu\Router\Router;

return function (Router $router) {
    $router->get('', HomeController::class);

    $router->prefix('auth/', function (Router $router) {
        $router->get('login', AuthController::class, 'login');
    });
};

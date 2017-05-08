<?php
namespace Wandu\Api\Http\Controllers;

use Wandu\Router\Router;

return function (Router $router) {
    $router->get('/', HelloWorld::class);
};

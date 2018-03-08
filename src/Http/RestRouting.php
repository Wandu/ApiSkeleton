<?php
namespace App\Http;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\PingController;
use App\Http\Middlewares as Middleware;
use Wandu\Router\Contracts\Routable;

class RestRouting
{
    /**
     * @param \Wandu\Router\Contracts\Routable $router
     */
    public function __invoke(Routable $router)
    {
        $router->createRoute(['GET', 'OPTIONS'], "/", PingController::class, "index");
        $router->prefix("/auth", function (Routable $router) {
            $router->options("/register", PingController::class, "index");
            $router->options("/login", PingController::class, "index");

            $router->post("/register", AuthController::class, "register")
                ->middleware(Middleware\Validation\RegisterRequest::class);
            $router->post("/login", AuthController::class, "login")
                ->middleware(Middleware\Validation\LoginRequest::class);
        });
        $router->middleware(Middleware\AuthGuard::class, function (Routable $router) {
            $router->get("/mypage", MyPageController::class, "index");
        });
    }
}

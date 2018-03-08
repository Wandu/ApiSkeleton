<?php
namespace App\Http\Middlewares;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Wandu\Router\Contracts\MiddlewareInterface;

class JwtAuth implements MiddlewareInterface
{
    public function __invoke(ServerRequestInterface $request, Closure $next)
    {
        return $next($request);
    }
}

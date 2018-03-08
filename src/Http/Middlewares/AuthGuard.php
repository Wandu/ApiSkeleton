<?php
namespace App\Http\Middlewares;

use App\Domain\Contracts\Loginable;
use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Wandu\Http\Psr\Response;
use Wandu\Router\Contracts\MiddlewareInterface;
use function Wandu\Http\response;

class AuthGuard implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ServerRequestInterface $request, Closure $next)
    {
        if (!$request->getAttribute(Loginable::class)) {
            return response()->json([
                'message' => "need authorize.",
            ], Response::HTTP_STATUS_UNAUTHORIZED);
        }
        return $next($request);
    }
}

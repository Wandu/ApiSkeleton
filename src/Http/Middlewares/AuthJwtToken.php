<?php
namespace Wandu\Api\Http\Middlewares;

use Closure;
use Exception;
use Psr\Http\Message\ServerRequestInterface;
use Wandu\Api\Jwt\Jwt;
use Wandu\Router\Contracts\MiddlewareInterface;

class AuthJwtToken implements MiddlewareInterface 
{
    /** @var \Wandu\Api\Jwt\Jwt */
    protected $jwt;
 
    /** @var string */
    protected $tokenHeader = 'X-Wandu-Token';
    
    public function __construct(Jwt $jwt)
    {
        $this->jwt = $jwt;
    }

    public function __invoke(ServerRequestInterface $request, Closure $next)
    {
        $token = $request->getHeaderLine($this->tokenHeader);
        if ($token) {
            try {
                $user = $this->jwt->parse($token)['user'];
                $request = $request->withAttribute('user', $user);
            } catch (Exception $e) {}
        }
        return $next($request);
    }
}

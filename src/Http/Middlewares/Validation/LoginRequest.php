<?php
namespace App\Http\Middlewares\Validation;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Wandu\Http\Contracts\ParsedBodyInterface;
use Wandu\Router\Contracts\MiddlewareInterface;
use function Wandu\Validator\validator;

class LoginRequest implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ServerRequestInterface $request, Closure $next)
    {
        $params = $request->getAttribute(ParsedBodyInterface::class);
        validator([
            'email' => 'email',
            'password' => ['string', 'length_min:8', 'length_max:36'],
        ])->assert($params->toArray());
        return $next($request);
    }
}

<?php
namespace App\Http\Jwt;

use Wandu\DI\ContainerInterface;
use Wandu\DI\ServiceProviderInterface;
use function Wandu\Foundation\config;

class JwtServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(ContainerInterface $app)
    {
        $app->bind(TokenGenerator::class, function () {
            return new TokenGenerator(config("jwt.key"), config("jwt.algorithm", "HS256"));
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot(ContainerInterface $app)
    {
    }
}

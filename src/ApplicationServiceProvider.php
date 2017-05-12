<?php
namespace Wandu\Api;

use Wandu\Api\Error\HttpErrorHandler;
use Wandu\DI\ContainerInterface;
use Wandu\DI\ServiceProviderInterface;
use Wandu\Foundation\Contracts\HttpErrorHandlerInterface;
use Wandu\Foundation\Contracts\KernelInterface;

class ApplicationServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(ContainerInterface $app)
    {
        $app->bind(HttpErrorHandlerInterface::class, HttpErrorHandler::class);
    }

    /**
     * {@inheritdoc}
     */
    public function boot(ContainerInterface $app)
    {
        $kernel = $app->get(KernelInterface::class);
        $kernel['routes'] = require __DIR__. '/../app/routes.php';
        $kernel['commands'] = require __DIR__. '/../app/commands.php';
    }
}

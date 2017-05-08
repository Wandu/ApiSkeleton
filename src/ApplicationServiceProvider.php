<?php
namespace Wandu\Api;

use Wandu\DI\ContainerInterface;
use Wandu\DI\ServiceProviderInterface;
use Wandu\Foundation\Contracts\HttpErrorHandlerInterface;
use Wandu\Foundation\Contracts\KernelInterface;
use Wandu\Foundation\Error\DefaultHttpErrorHandler;

class ApplicationServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(ContainerInterface $app)
    {
        $app->bind(HttpErrorHandlerInterface::class, DefaultHttpErrorHandler::class);
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

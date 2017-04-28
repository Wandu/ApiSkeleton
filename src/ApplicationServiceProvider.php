<?php
namespace Wandu\Api;

use Wandu\DI\ContainerInterface;
use Wandu\DI\ServiceProviderInterface;
use Wandu\Foundation\Contracts\HttpErrorHandlerInterface;
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
    }
}

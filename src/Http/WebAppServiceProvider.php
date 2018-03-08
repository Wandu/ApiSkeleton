<?php
namespace App\Http;

use App\Http\Error\HttpErrorHandler;
use Wandu\DI\ContainerInterface;
use Wandu\DI\ServiceProviderInterface;
use Wandu\Foundation\WebApp\Contracts\HttpErrorHandler as BaseHttpErrorHandler;

class WebAppServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(ContainerInterface $app)
    {
        $app->bind(BaseHttpErrorHandler::class, HttpErrorHandler::class);
    }

    /**
     * {@inheritdoc}
     */
    public function boot(ContainerInterface $app)
    {
    }
}

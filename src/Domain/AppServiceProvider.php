<?php
namespace App\Domain;

use App\Domain\Contracts\UserRepositoryInterface;
use App\Domain\Repository\UserRepository;
use Wandu\DI\ContainerInterface;
use Wandu\DI\ServiceProviderInterface;

class AppServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(ContainerInterface $app)
    {
        $app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * {@inheritdoc}
     */
    public function boot(ContainerInterface $app)
    {
    }
}

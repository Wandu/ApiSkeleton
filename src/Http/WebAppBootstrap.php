<?php
namespace App\Http;

use App\Http\Jwt\JwtServiceProvider;
use App\Http\Middlewares\JwtAuth;
use Wandu\Config\ConfigServiceProvider;
use Wandu\Config\Contracts\Config;
use Wandu\Config\Exception\CannotLoadException;
use Wandu\DI\ContainerInterface;
use Wandu\Foundation\WebApp\Bootstrap;
use Wandu\Http\HttpServiceProvider;
use Wandu\Router\Contracts\Routable;
use Wandu\Router\Middleware\Cors;
use Wandu\Router\Middleware\Parameterify;
use Wandu\Router\RouterServiceProvider;
use Wandu\Service\NeomerxCors\CorsServiceProvider;

class WebAppBootstrap extends Bootstrap
{
    /**
     * {@inheritdoc}
     */
    public function providers(): array
    {
        $providers = require __DIR__ . '/../../providers.php';
        $providers[] = new ConfigServiceProvider();
        $providers[] = new HttpServiceProvider();
        $providers[] = new RouterServiceProvider();
        $providers[] = new CorsServiceProvider();
        $providers[] = new JwtServiceProvider();
        $providers[] = new WebAppServiceProvider();
        return $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function registerConfiguration(Config $config)
    {
        $config->load(__DIR__ . '/../../config');
        try {
            $config->load(__DIR__ . '/../../env.yml');
        } catch (CannotLoadException $e) {
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setRoutes(Routable $router)
    {
        $router->group([
//            'domains' => [
//                'api.yourapplication.test',
//                'api.dev.yourapplication.com',
//                'api.staging.yourapplication.com',
//                'api.yourapplication.com',
//            ],
            'middleware' => [
                Parameterify::class,
                Cors::class,
                JwtAuth::class,
            ],
        ], new RestRouting());
    }

    /**
     * {@inheritdoc}
     */
    public function boot(ContainerInterface $app)
    {
        date_default_timezone_set($app->get(Config::class)->get('timezone', 'UTC'));
        parent::boot($app);
    }
}

<?php
use Doctrine\Common\Annotations\AnnotationRegistry;
use Wandu\Api\ApplicationDefinition;
use Wandu\Foundation\Application;
use Wandu\Foundation\Kernels\HttpRouterKernel;

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "cannot find autoload.php. you may run composer install.";
    exit(-1);
}

$autoload = require_once __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$autoload, 'loadClass']);

$app = new Application(new HttpRouterKernel(new ApplicationDefinition()));
exit($app->execute());

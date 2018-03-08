<?php

use App\Http\WebAppBootstrap;
use Wandu\Foundation\Application;

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "cannot find autoload.php. you may run composer install.";
    exit(-1);
}

chdir(__DIR__ . '/..');

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(new WebAppBootstrap());
$app->setAsGlobal();
exit($app->execute());

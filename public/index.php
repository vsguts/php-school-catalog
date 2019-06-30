<?php

use App\Application;
use App\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

$router = require __DIR__ . '/../routes/routes.php';

$app = new Application($router);

$request = new Request;
$app->handleRequest($request);

$phinxApp = new \Phinx\Console\PhinxApplication();
$phinxTextWrapper = new \Phinx\Wrapper\TextWrapper($phinxApp);

$phinxTextWrapper->setOption('configuration', '/../phinx.yml');
$phinxTextWrapper->setOption('parser', 'YAML');
$phinxTextWrapper->setOption('environment', 'development');
$phinxTextWrapper->getMigrate();

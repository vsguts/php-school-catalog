<?php

use App\Application;
use App\Http\Request;

require __DIR__ . '/../bootstrap/bootstrap.php';

$router = require __DIR__ . '/../routes/routes.php';

$app = new Application($router);

$request = new Request;

echo $app->handRequest($request);


//- Нужно сделать так, чтобы контроллеры не выводили результат на экран, а возвращали этот результат.
//- А в index.php надо поставить echo перед $app->handleRequest($request); чтобы результат вывелся на экран.

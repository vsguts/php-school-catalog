<?php

use App\Controllers\{FormController, IndexController, APIController};
use App\Http\Router;

$router = new Router();

$router->add('get', '/', IndexController::class, 'index');
$router->add('get', '/forms', FormController::class, 'index');
$router->add('get', '/forms/view', FormController::class, 'view');
$router->add('post', '/forms/create', FormController::class, 'create');
$router->add('get', '/forms/delete', FormController::class, 'delete');
$router->add('get', '/forms/update', FormController::class, 'edit');
$router->add('post', '/forms/save', FormController::class, 'update');

$router->add('get', '/api/forms', APIController::class, 'index');
$router->add('get', '/api/forms/view', APIController::class, 'view');
$router->add('post', '/api/forms', APIController::class, 'create');
$router->add('put', '/api/forms/view', APIController::class, 'update');
$router->add('delete', '/api/forms/view', APIController::class, 'delete');

return $router;

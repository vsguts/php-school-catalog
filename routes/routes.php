<?php

use App\Controllers\FormController;
use App\Controllers\IndexController;
use App\Http\Router;

$router = new Router();

$router->add('get', '/', IndexController::class, 'index');
$router->add('get', '/forms', FormController::class, 'index');
$router->add('get', '/forms/view', FormController::class, 'view');
$router->add('post', '/forms/create', FormController::class, 'create');
$router->add('get', '/forms/delete', FormController::class, 'delete');
$router->add('get', '/forms/update', FormController::class, 'edit');
$router->add('post', '/forms/save', FormController::class, 'update');

return $router;

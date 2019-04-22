<?php

use App\Controllers\API\ApiFormController;
use App\Controllers\FormController;
use App\Controllers\IndexController;
use App\Http\Router;

$router = new Router();

$router->add('get', '/', IndexController::class, 'index');
$router->add('get', '/forms', FormController::class, 'index');
$router->add('get', '/forms/view', FormController::class, 'view');
$router->add('post', '/forms/create', FormController::class, 'create');
$router->add('get', '/forms/delete', FormController::class, 'delete');

$router->add('get', '/forms/update', FormController::class, 'update');
$router->add('post', '/forms/save', FormController::class, 'save');


$router->add('get', '/api/forms', ApiFormController::class, 'index');
$router->add('get', '/api/forms/view', ApiFormController::class, 'view');
$router->add('post', '/api/forms/create', ApiFormController::class, 'create');
$router->add('get', '/api/forms/update', ApiFormController::class, 'update');
$router->add('get', '/api/forms/delete', ApiFormController::class, 'delete');

return $router;

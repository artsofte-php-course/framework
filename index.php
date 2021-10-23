<?php
require_once 'controllers/IndexController.php';
require_once 'controllers/HelloWorldController.php';

require_once 'core/Request.php';
require_once 'core/Response.php';
require_once 'core/Router.php';

include_once 'config/routes.php';

$router = new Router($routes);
$request = Request::createFromGlobals();

try {
    $route = $router->match($request->getPath());
} catch (\InvalidArgumentException $exception) {
    $route = [
        'controller' => 'index',
        'action' => 'index'
    ];
}

$controllerClassName = sprintf('%sController',
    ucfirst($route['controller']));

$actionMethod = $route['action'] . 'Action';

$controller = new $controllerClassName();
/** @var Response $response */
$response = $controller->$actionMethod();
$response->send();
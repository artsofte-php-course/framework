<?php
require_once 'controllers/IndexController.php';
require_once 'controllers/HelloWorldController.php';

require_once 'core/Request.php';
require_once 'core/Response.php';
require_once 'core/Router.php';

require_once 'repositories/ArticleRepository.php';

include_once 'config/routes.php';
include_once 'config/database.php';


$router = new Router($routes);
$request = Request::createFromGlobals();


$dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", $database['database_host'], $database['database_name'],  $database['charset']);
/** @var PDO $connection */
$connection = new PDO( $dsn, $database['username'], $database['password']);

$articleRepository = new ArticleRepository($connection);


try {
    $route = $router->match($request->getPath());
} catch (\InvalidArgumentException $exception) {
    $route = [
        'controller' => 'index',
        'action' => 'index'
    ];
}

$controllers = [
    'index' => new IndexController($articleRepository),
    'helloWorld' => new HelloWorldController(),
];

$controller = $controllers[$route['controller']];
$actionMethod = $route['action'] . 'Action';

/** @var Response $response */
$response = $controller->$actionMethod($request);
$response->send();
<?php
require_once 'controllers/TableController.php';
require_once 'controllers/IndexController.php';
require_once 'controllers/ContractsController.php';

require_once 'core/Request.php';
require_once 'core/Response.php';
require_once 'core/Router.php';

require_once 'repositories/SellsRepository.php';
require_once 'repositories/AgentsRepository.php';
require_once 'repositories/ContractsRepository.php';

include_once 'config/routes.php';
include_once 'config/database.php';


$router = new Router($routes);
$request = Request::createFromGlobals();


$dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", $database['database_host'], $database['database_name'], $database['charset']);
/** @var PDO $connection */
$connection = new PDO($dsn, $database['username'], $database['password']);

$sellsRepository = new SellsRepository($connection);
$agentsRepository = new AgentsRepository($connection);
$contractsRepository = new ContractsRepository($connection);

try {
    $route = $router->match($request->getPath());
} catch (InvalidArgumentException $exception) {
    if (is_null($request->getPath())) {
        $route = [
            'controller' => 'index',
            'action' => 'index'
        ];
    } else {
        $route = [
            'controller' => 'index',
            'action' => 'error'
        ];
    }
}

$controllers = [
    'table' => new TableController($contractsRepository, $sellsRepository, $agentsRepository),
    'index' => new IndexController(),
    'contracts' => new ContractsController($contractsRepository, $agentsRepository)
];

$controller = $controllers[$route['controller']];
$actionMethod = $route['action'] . 'Action';

/** @var Response $response */
$response = $controller->$actionMethod($request);
$response->send();
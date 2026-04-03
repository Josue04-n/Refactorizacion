<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;
use Lenovo\ProyectoRefactorizacion\Infrastructure\Database\DatabaseConnection;
use Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence\MySQLCategoryRepository;
use Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence\MySQLThreadRepository;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCategoriesUseCase;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetThreadsByCategoryUseCase;
use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;
use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\CategoryController;
use Lenovo\ProyectoRefactorizacion\Presentation\Routing\RouterConfigurator;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$databaseConnection = new DatabaseConnection(
    $_ENV['DB_HOST'],
    $_ENV['DB_DATABASE'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD']
);

$pdo = $databaseConnection->connect();

$categoryRepository = new MySQLCategoryRepository($pdo);
$getCategoriesUseCase = new GetCategoriesUseCase($categoryRepository);

$threadRepository = new MySQLThreadRepository($pdo);
$getThreadsByCategoryUseCase = new GetThreadsByCategoryUseCase($threadRepository);

$viewsPath = __DIR__ . '/../views';
$viewRenderer = new ViewRenderer($viewsPath);

$categoryController = new CategoryController(
    $getCategoriesUseCase, 
    $getThreadsByCategoryUseCase,
    $viewRenderer
);

$router = new Router();
$routerConfigurator = new RouterConfigurator($router, $categoryController);
$routerConfigurator->registerRoutes();
$router->run();
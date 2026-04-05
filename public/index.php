<?php
declare(strict_types=1);

session_start();

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
use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\ThreadController;
use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\AuthController;
use Lenovo\ProyectoRefactorizacion\Domain\Entities\User;
use Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence\MySQLUserRepository;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\LoginUserUseCase;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\RegisterUserUseCase;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCommentsByThreadUseCase;
use Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence\MySQLCommentRepository;

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

$commentRepository = new MySQLCommentRepository($pdo);
$getCommentsByThreadUseCase = new GetCommentsByThreadUseCase($commentRepository);

$searchThreadsUseCase = new SearchThreadsUseCase($threadRepository);
$searchController = new SearchController($searchThreadsUseCase, $viewRenderer);

$viewsPath = __DIR__ . '/../views';
$viewRenderer = new ViewRenderer($viewsPath);

$createThreadUseCase = new \Lenovo\ProyectoRefactorizacion\Application\UseCases\CreateThreadUseCase($threadRepository);
$createCommentUseCase = new \Lenovo\ProyectoRefactorizacion\Application\UseCases\CreateCommentUseCase($commentRepository);

$categoryController = new CategoryController(
    $getCategoriesUseCase,
    $getThreadsByCategoryUseCase,
    $createThreadUseCase,
    $viewRenderer
);

$threadController = new ThreadController(
    $getCommentsByThreadUseCase,
    $createCommentUseCase,
    $viewRenderer
);

$userRepository = new MySQLUserRepository($pdo);
$registerUserUseCase = new RegisterUserUseCase($userRepository);
$loginUserUseCase = new LoginUserUseCase($userRepository);

$authController = new AuthController(
    $registerUserUseCase,
    $loginUserUseCase,
    $viewRenderer
);

$router = new Router();
$routerConfigurator = new RouterConfigurator(
    $router, 
    $categoryController, 
    $threadController, 
    $authController, 
    $searchController
);

$routerConfigurator->registerRoutes();
$router->run();
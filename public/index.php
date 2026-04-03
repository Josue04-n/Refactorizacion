<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

$router->get('/', function () {
    echo "¡La nueva Clean Architecture de iDiscuss está funcionando!";
});

$router->run();
?>
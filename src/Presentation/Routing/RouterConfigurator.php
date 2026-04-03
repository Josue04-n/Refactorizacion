<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Routing;
    

    use Bramus\Router\Router;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\CategoryController;

    class RouterConfigurator
    {
        private Router $_router;
        private CategoryController $_categoryController;

        public function __construct(Router $router, CategoryController $categoryController)
        {
            $this->_router = $router;
            $this->_categoryController = $categoryController;
        }

        public function registerRoutes(): void
        {
            $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
            $this->_router->setBasePath($basePath);

            $controller = $this->_categoryController;

            $this->_router->get('/', function () use ($controller) {
                $controller->index();
            });

            $this->_router->get('/categoria/(\d+)', function (string $id) use ($controller) {
                $controller->show($id);
            });
        }
    }
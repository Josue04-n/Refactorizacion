<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Routing;
    

    use Bramus\Router\Router;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\CategoryController;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\ThreadController;

    class RouterConfigurator
    {
        private Router $_router;
        private CategoryController $_categoryController;
        private ThreadController $_threadController;

        public function __construct(
            Router $router, 
            CategoryController $categoryController,
            ThreadController $threadController
        ){
            $this->_router = $router;
            $this->_categoryController = $categoryController;
            $this->_threadController = $threadController;
            
        }

        public function registerRoutes(): void
        {
            $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
            $this->_router->setBasePath($basePath);

            $categoryController = $this->_categoryController;
            $threadController = $this->_threadController;

            $this->_router->get('/', function () use ($categoryController) {
                $categoryController->index();
            });

            $this->_router->get('/categoria/(\d+)', function (string $id) use ($categoryController) {
                $categoryController->show($id);
            });

            $this->_router->get('/hilo/(\d+)', function (string $id) use ($threadController) {
                $threadController->show($id);
            });
        }
    }
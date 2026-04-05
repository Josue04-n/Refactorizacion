<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Routing;
    

    use Bramus\Router\Router;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\CategoryController;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\ThreadController;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\AuthController;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\SearchController;
    use Lenovo\ProyectoRefactorizacion\Presentation\Controllers\PageController;

    class RouterConfigurator
    {
        private Router $_router;
        private CategoryController $_categoryController;
        private ThreadController $_threadController;
        private AuthController $_authController;
        private SearchController $_searchController;
        private PageController $_pageController;

        public function __construct(
            Router $router, 
            CategoryController $categoryController,
            ThreadController $threadController,
            AuthController $authController,
            SearchController $searchController,
            PageController $pageController,
        ){
            $this->_router = $router;
            $this->_categoryController = $categoryController;
            $this->_threadController = $threadController;
            $this->_authController = $authController;
            $this->_searchController = $searchController;
            $this->_pageController = $pageController;
            

        }

        public function registerRoutes(): void
        {
            $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
            $this->_router->setBasePath($basePath);

            $categoryController = $this->_categoryController;
            $threadController = $this->_threadController;
            $authController = $this->_authController;
            $searchController = $this->_searchController;
            $pageController = $this->_pageController;


            $this->_router->get('/', function () use ($categoryController) {
                $categoryController->index();
            });

            $this->_router->get('/categoria/(\d+)', function (string $id) use ($categoryController) {
                $categoryController->show($id);
            });

            $this->_router->post('/categoria/(\d+)/hilo', function (string $categoryId) use ($categoryController) {
                $categoryController->storeThread($categoryId);
            });

            $this->_router->get('/hilo/(\d+)', function (string $id) use ($threadController) {
                $threadController->show($id);
            });

            $this->_router->post('/hilo/(\d+)/comentario', function (string $threadId) use ($threadController) {
                $threadController->storeComment($threadId);
            });

            $this->_router->get('/login', function () use ($authController) {
                $authController->showLogin();
            });

            $this->_router->post('/login', function () use ($authController) {
                $authController->login();
            });

            $this->_router->get('/register', function () use ($authController) {
                $authController->showRegister();
            });

            $this->_router->post('/register', function () use ($authController) {
                $authController->register();
            });

            $this->_router->get('/logout', function () use ($authController) {
                $authController->logout();
            });

            $this->_router->get('/buscar', function () use ($searchController) {
                $searchController->index();
            });

            $this->_router->get('/about', function () use ($pageController) {
                 $pageController->about();
             });

            $this->_router->get('/contact', function () use ($pageController) {
                $pageController->contact();
            });

            $this->_router->post('/contact/guardar', function () use ($pageController) {
                $pageController->storeContact();
            });

        }
    }
<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Routing;
    

    use Bramus\Router\Router;

    class RouterConfigurator
    {
        private Router $_router;

        public function __construct(Router $router)
        {
            $this->_router = $router;
        }

        public function registerRoutes(): void
        {
            $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
            $this->_router->setBasePath($basePath);
            $this->_router->setNamespace('\Lenovo\ProyectoRefactorizacion\Presentation\Controllers');

            $this->_router->get('/', 'CategoryController@index');
            $this->_router->get('/categoria/(\d+)', 'CategoryController@show');
        }
    }




?>
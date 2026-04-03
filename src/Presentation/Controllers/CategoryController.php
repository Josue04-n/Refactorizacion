<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

    use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;
    
    class CategoryController
    {
        private ViewRenderer $_viewRenderer;

        public function __construct(){
            $viewsPath = __DIR__ . '/../../../views';
            $this->_viewRenderer = new ViewRenderer($viewsPath);
        }

        public function index() {
            $this->_viewRenderer->render('category/index', [
            'titulo' => 'Foro Principal'
        ]);
        }

        public function show(string $id): void {
            echo "Mostrando el contenido de la categoría con ID: " . htmlspecialchars($id);
        }
    }
?>
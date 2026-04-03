<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

    use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;
    use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCategoriesUseCase;

    class CategoryController
    {
        private GetCategoriesUseCase $_getCategoriesUseCase;
        private ViewRenderer $_viewRenderer;

        public function __construct(
        GetCategoriesUseCase $getCategoriesUseCase,
        ViewRenderer $viewRenderer
        ) {
            $this->_getCategoriesUseCase = $getCategoriesUseCase;
            $this->_viewRenderer = $viewRenderer;
        }

        public function index(): void
        {
            $categories = $this->_getCategoriesUseCase->execute();

            $this->_viewRenderer->render('category/index', [
                'categories' => $categories
            ]);
        }

        public function show(string $id): void {
            echo "Mostrando el contenido de la categoría con ID: " . htmlspecialchars($id);
        }
    }
?>
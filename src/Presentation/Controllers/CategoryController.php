<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

    use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCategoriesUseCase;
    use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetThreadsByCategoryUseCase;
    use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;

    class CategoryController
    {
        private GetThreadsByCategoryUseCase $_getThreadsByCategoryUseCase;
        private GetCategoriesUseCase $_getCategoriesUseCase;
        private ViewRenderer $_viewRenderer;

        public function __construct(
        GetCategoriesUseCase $getCategoriesUseCase,
        GetThreadsByCategoryUseCase $getThreadsByCategoryUseCase,
        ViewRenderer $viewRenderer
        ) {
            $this->_getThreadsByCategoryUseCase = $getThreadsByCategoryUseCase;
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
            $categoryId = (int) $id;
            $threads = $this->_getThreadsByCategoryUseCase->execute($categoryId);
            $this->_viewRenderer->render('category/show', [
                'threads' => $threads
            ]);
        }
    }
?>
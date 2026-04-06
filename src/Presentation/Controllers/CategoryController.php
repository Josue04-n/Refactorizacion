<?php
    declare(strict_types=1);

    namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

    use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCategoriesUseCase;
    use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetThreadsByCategoryUseCase;
    use Lenovo\ProyectoRefactorizacion\Application\UseCases\CreateThreadUseCase;
    use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;

    class CategoryController
    {
        private GetThreadsByCategoryUseCase $_getThreadsByCategoryUseCase;
        private GetCategoriesUseCase $_getCategoriesUseCase;
        private CreateThreadUseCase $_createThreadUseCase;
        private ViewRenderer $_viewRenderer;

        public function __construct(
            GetCategoriesUseCase $getCategoriesUseCase,
            GetThreadsByCategoryUseCase $getThreadsByCategoryUseCase,
            CreateThreadUseCase $createThreadUseCase,
            ViewRenderer $viewRenderer
        ) {
            $this->_getThreadsByCategoryUseCase = $getThreadsByCategoryUseCase;
            $this->_getCategoriesUseCase = $getCategoriesUseCase;
            $this->_createThreadUseCase = $createThreadUseCase;
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

            $category = null;
            $categories = $this->_getCategoriesUseCase->execute();

            foreach ($categories as $item) {
                if ($item->getId() === $categoryId) {
                    $category = $item;
                    break;
                }
            }

            $this->_viewRenderer->render('thread/list', [
                'threads' => $threads,
                'category' => $category
            ]);
        }
        /**
         * Maneja la creación de un nuevo hilo vía POST.
         */
        public function storeThread(string $categoryId): void
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = trim($_POST['thread_title'] ?? $_POST['title'] ?? '');
                $description = trim($_POST['thread_desc'] ?? $_POST['description'] ?? '');
                // Suponiendo que el ID de usuario está en sesión
                $userId = $_SESSION['user_id'] ?? null;
                if ($userId && $title && $description) {
                    $this->_createThreadUseCase->execute($title, $description, (int)$categoryId, (int)$userId);
                    }
                // Redirigir a la vista de la categoría para evitar reenvío
                $baseUrl = defined('BASE_URL') ? BASE_URL : '';
                header('Location: ' . $baseUrl . '/categoria/' . $categoryId);
                exit;
            }
        }
    }
?>
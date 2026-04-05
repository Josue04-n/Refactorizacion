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

        public function storeThread(){
            if(!isset($_SESSION['user_id'])){
                header('Location: /proyectorefactorizacion/public/login');
                exit();
            }
            $category = (int) $categoryId;
            $user = (int) $_SESSION['user_id'];
            $title = $_POST['thread_title'] ?? '';
            $description = $_POST['thread_desc'] ?? '';

            $this->_createThreadUseCase->execute($title, $description, $category, $user);

            header("Location: /proyectorefactorizacion/public/categoria/" . $category);
            exit;
        }
    }
?>
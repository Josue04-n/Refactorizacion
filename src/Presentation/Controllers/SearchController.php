<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

use Lenovo\ProyectoRefactorizacion\Application\UseCases\SearchThreadsUseCase;
use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;

class SearchController
{
    private SearchThreadsUseCase $_searchThreadsUseCase;
    private ViewRenderer $_viewRenderer;

    public function __construct(
        SearchThreadsUseCase $searchThreadsUseCase,
        ViewRenderer $viewRenderer
    ) {
        $this->_searchThreadsUseCase = $searchThreadsUseCase;
        $this->_viewRenderer = $viewRenderer;
    }

    public function index(): void
    {
        // Capturamos el parámetro 'search' de la URL 
        $keyword = $_GET['search'] ?? '';

        try {
            $results = $this->_searchThreadsUseCase->execute((string) $keyword);
        } catch (\RuntimeException $exception) {
            $results = [];
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Ocurrio un error al realizar la busqueda. Intenta nuevamente.'
            ];
        }

        $this->_viewRenderer->render('search/index', [
            'keyword' => $keyword,
            'results' => $results
        ]);
    }
}
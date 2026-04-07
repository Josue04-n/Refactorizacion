<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Lenovo\ProyectoRefactorizacion\Domain\Repositories\ThreadRepositoryInterface;

class SearchThreadsUseCase
{
    private ThreadRepositoryInterface $_threadRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository)
    {
        $this->_threadRepository = $threadRepository;
    }

    /**
     * Ejecuta la búsqueda de hilos.
     *
     * @param string $keyword
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread>
     */
    
    public function execute(string $keyword): array
    {
        $keyword = trim($keyword);

        // Validación temprana: si la búsqueda está vacía, no consultamos la BD
        if ($keyword === '') {
            return [];
        }

        return $this->_threadRepository->search($keyword);
    }
}
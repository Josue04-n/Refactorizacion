<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\ThreadRepositoryInterface;

 class GetThreadsByCategoryUseCase{

    private readonly ThreadRepositoryInterface $_threadRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository)
    {
        $this->_threadRepository = $threadRepository;
    }

    /**
     * Ejecuta el caso de uso para obtener los hilos por categoría.
     *
     * @param int $categoryId El ID de la categoría.
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread> El array de hilos correspondientes a la categoría.
     */
    public function execute(int $categoryId): array
    {
        return $this->_threadRepository->getByCategoryId($categoryId);
    }
 }



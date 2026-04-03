<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Repositories;

interface ThreadRepositoryInterface
{
    /**
     * Obtiene todos los hilos que pertenecen a una categoría específica.
     *
     * @param int $categoryId El ID de la categoría
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread>
     */
    public function getByCategoryId(int $categoryId): array;
}
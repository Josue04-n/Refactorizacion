<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Repositories;

interface ThreadRepositoryInterface
{
    /**
     * Obtiene un hilo por su ID.
     *
     * @param int $threadId El ID del hilo
     * @return \Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread|null
     */
    public function getById(int $threadId): ?\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread;

    /**
     * Obtiene todos los hilos que pertenecen a una categoría específica.
     *
     * @param int $categoryId El ID de la categoría
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread>
     */
    public function getByCategoryId(int $categoryId): array;

    /**
     * Busca hilos por palabra clave.
     *
     * @param string $keyword La palabra clave de búsqueda
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread>
     */
    public function search(string $keyword): array;

    /**
     * Guarda un hilo en la base de datos.
     * @param \Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread $thread
     * @return bool
     */
    public function save(\Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread $thread): bool;
}
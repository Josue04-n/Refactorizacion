<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Repositories;

interface CommentRepositoryInterface {
    /**
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Comment>
     */
    public function getByThreadId(int $threadId): array;

    /**
     * Guarda un comentario en la base de datos.
     * @param \Lenovo\ProyectoRefactorizacion\Domain\Entities\Comment $comment
     * @return bool
     */
    public function save(\Lenovo\ProyectoRefactorizacion\Domain\Entities\Comment $comment): bool;
}
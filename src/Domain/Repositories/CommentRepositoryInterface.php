<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Repositories;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Comment;

interface CommentRepositoryInterface {
    /**
     * @return array<Comment>
     */
    public function getByThreadId(int $threadId): array;

    /**
     * Guarda un comentario en la base de datos.
     * @param Comment $comment
     * @return bool
     */
    public function save(Comment $comment): bool;
}
<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Repositories;

interface CommentRepositoryInterface {
    /**
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Comment>
     */
    public function getByThreadId(int $threadId): array;
}
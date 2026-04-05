<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Lenovo\ProyectoRefactorizacion\Domain\Repositories\CommentRepositoryInterface;

class GetCommentsByThreadUseCase
{
    private readonly CommentRepositoryInterface $_commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->_commentRepository = $commentRepository;
    }

    /**
     * Obtiene todos los comentarios de un hilo específico.
     *
     * @param int $threadId
     * @return array
     */
    public function execute(int $threadId): array
    {
        return $this->_commentRepository->getByThreadId($threadId);
    }
}
<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use InvalidArgumentException;
use Lenovo\ProyectoRefactorizacion\Domain\Entities\Comment;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\CommentRepositoryInterface;

class CreateCommentUseCase
{
    private readonly CommentRepositoryInterface $_commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->_commentRepository = $commentRepository;
    }

    public function execute(string $content, int $threadId, int $userId): void
    {
        if (trim($content) === '') {
            throw new InvalidArgumentException('El contenido del comentario no puede estar vacío.');
        }

        $comment = new Comment(
            0,
            $content,
            $threadId,
            $userId,
            date('Y-m-d H:i:s')
        );

        $this->_commentRepository->save($comment);
    }
}
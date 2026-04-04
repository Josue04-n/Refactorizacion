<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCommentsByThreadUseCase;
use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;

class ThreadController
{
    private GetCommentsByThreadUseCase $_getCommentsByThreadUseCase;
    private ViewRenderer $_viewRenderer;

    public function __construct(
        GetCommentsByThreadUseCase $getCommentsByThreadUseCase,
        ViewRenderer $viewRenderer
    ) {
        $this->_getCommentsByThreadUseCase = $getCommentsByThreadUseCase;
        $this->_viewRenderer = $viewRenderer;
    }

    public function show(string $id): void
    {
        $threadId = (int) $id;
        $comments = $this->_getCommentsByThreadUseCase->execute($threadId);

        $this->_viewRenderer->render('thread/show', [
            'comments' => $comments,
            'threadId' => $threadId
        ]);
    }
}
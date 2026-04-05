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

    public function storeComment(string $threadId): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /proyectorefactorizacion/public/login');
            exit();
        }

        $threadId = (int) $id;
        $userId = (int) $_SESSION['user_id'];
        $content = $_POST['comment_content'] ?? '';

        
         $this->_createCommentUseCase->execute($content, $threadId, $userId);

        header("Location: /proyectorefactorizacion/public/thread/" . $threadId);
        exit();
    }
}
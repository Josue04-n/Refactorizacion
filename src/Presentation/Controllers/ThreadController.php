<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCommentsByThreadUseCase;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\CreateCommentUseCase;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetThreadByIdUseCase;
use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;

class ThreadController
{
    private GetCommentsByThreadUseCase $_getCommentsByThreadUseCase;
    private CreateCommentUseCase $_createCommentUseCase;
    private GetThreadByIdUseCase $_getThreadByIdUseCase;
    private ViewRenderer $_viewRenderer;

    public function __construct(
        GetCommentsByThreadUseCase $getCommentsByThreadUseCase,
        CreateCommentUseCase $createCommentUseCase,
        GetThreadByIdUseCase $getThreadByIdUseCase,
        ViewRenderer $viewRenderer
    ) {
        $this->_getCommentsByThreadUseCase = $getCommentsByThreadUseCase;
        $this->_createCommentUseCase = $createCommentUseCase;
        $this->_getThreadByIdUseCase = $getThreadByIdUseCase;
        $this->_viewRenderer = $viewRenderer;
    }

    public function show(string $id): void
    {
        $threadId = (int) $id;
        $thread = $this->_getThreadByIdUseCase->execute($threadId);
        $comments = $this->_getCommentsByThreadUseCase->execute($threadId);

        $this->_viewRenderer->render('thread/show', [
            'thread' => $thread,
            'comments' => $comments,
            'threadId' => $threadId
        ]);
    }
    /**
     * Maneja la creación de un nuevo comentario vía POST.
     */
    public function storeComment(string $threadId): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? $_POST['comment_content'] ?? '');
            // Suponiendo que el ID de usuario está en sesión
            $userId = $_SESSION['user_id'] ?? null;
            if ($userId && $content) {
                $this->_createCommentUseCase->execute($content, (int)$threadId, (int)$userId);
            }
            // Redirigir a la vista del hilo para evitar reenvío
            $baseUrl = defined('BASE_URL') ? BASE_URL : '';
            header('Location: ' . $baseUrl . '/hilo/' . $threadId);
            exit;
        }
    }
}
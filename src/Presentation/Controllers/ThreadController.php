<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

use Lenovo\ProyectoRefactorizacion\Application\UseCases\GetCommentsByThreadUseCase;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\CreateCommentUseCase;
use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;

class ThreadController
{
    private GetCommentsByThreadUseCase $_getCommentsByThreadUseCase;
    private CreateCommentUseCase $_createCommentUseCase;
    private ViewRenderer $_viewRenderer;

    public function __construct(
        GetCommentsByThreadUseCase $getCommentsByThreadUseCase,
        CreateCommentUseCase $createCommentUseCase,
        ViewRenderer $viewRenderer
    ) {
        $this->_getCommentsByThreadUseCase = $getCommentsByThreadUseCase;
        $this->_createCommentUseCase = $createCommentUseCase;
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
    /**
     * Maneja la creación de un nuevo comentario vía POST.
     */
    public function storeComment(string $threadId): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'] ?? '';
            // Suponiendo que el ID de usuario está en sesión
            $userId = $_SESSION['user_id'] ?? null;
            if ($userId && $content) {
                $this->_createCommentUseCase->execute($content, (int)$threadId, (int)$userId);
            }
            // Redirigir a la vista del hilo para evitar reenvío
            header('Location: /hilo/' . $threadId);
            exit;
        }
    }
}
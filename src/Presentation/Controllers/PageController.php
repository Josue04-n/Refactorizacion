<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\SaveContactMessageUseCase;



class PageController
{
    private ViewRenderer $_viewRenderer;
    private SaveContactMessageUseCase $_saveContactMessageUseCase;

    public function __construct(
        ViewRenderer $viewRenderer,
        SaveContactMessageUseCase $saveContactMessageUseCase
    )
    {
        $this->_viewRenderer = $viewRenderer;
        $this->_saveContactMessageUseCase = $saveContactMessageUseCase;

    }

    public function about(): void
    {
        $this->_viewRenderer->render('pages/about', [
            'titulo' => 'Acerca de iDiscuss'
        ]);
    }

    public function contact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->_viewRenderer->render('pages/contact');
            return;
        }

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['errormessage'] = "Por favor, inicia sesión para contactarnos.";
            header('Location: /proyectorefactorizacion/public/login');
            exit;
        }

        $userId = (int) $_SESSION['user_id'];
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $contactPhone = trim($_POST['contact'] ?? '');
        $message = trim($_POST['message'] ?? '');

        try {
            $this->_saveContactMessageUseCase->execute($userId, $username, $email, $contactPhone, $message);
            $_SESSION['successmessage'] = "Tu mensaje ha sido enviado correctamente.";
        } catch (\InvalidArgumentException $e) {
            $_SESSION['errormessage'] = $e->getMessage();
        }

        header('Location: /proyectorefactorizacion/public/contact');
        exit;
    }
}
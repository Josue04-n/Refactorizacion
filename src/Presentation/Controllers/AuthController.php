<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;

use Lenovo\ProyectoRefactorizacion\Application\UseCases\LoginUserUseCase;
use Lenovo\ProyectoRefactorizacion\Application\UseCases\RegisterUserUseCase;
use Lenovo\ProyectoRefactorizacion\Presentation\Views\ViewRenderer;
use Exception;

class AuthController
{
    private RegisterUserUseCase $_registerUseCase;
    private LoginUserUseCase $_loginUseCase;
    private ViewRenderer $_viewRenderer;

    public function __construct(
        RegisterUserUseCase $registerUseCase,
        LoginUserUseCase $loginUseCase,
        ViewRenderer $viewRenderer
    ) {
        $this->_registerUseCase = $registerUseCase;
        $this->_loginUseCase = $loginUseCase;
        $this->_viewRenderer = $viewRenderer;
    }

    public function showLogin(): void
    {
        $this->_viewRenderer->render('auth/login');
    }

    public function showRegister(): void
    {
        $this->_viewRenderer->render('auth/register');
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                $userId = $this->_loginUseCase->execute($email, $password);
                
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['user_id'] = $userId;
                $_SESSION['useremail'] = $email;
                $_SESSION['loggedin'] = true;

                header('Location: /');
                exit;
            } catch (Exception $e) {
                // Manejar error (ej. pasando mensaje a la vista)
                $this->_viewRenderer->render('auth/login', ['error' => $e->getMessage()]);
            }
        }
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $cpassword = $_POST['cpassword'] ?? '';

            if ($password !== $cpassword) {
                $this->_viewRenderer->render('auth/register', ['error' => 'Las contraseñas no coinciden']);
                return;
            }

            try {
                $success = $this->_registerUseCase->execute($username, $email, $password);
                if ($success) {
                    header('Location: /login?registrosuccess=true');
                    exit;
                } else {
                    $this->_viewRenderer->render('auth/register', ['error' => 'No se pudo registrar el usuario.']);
                }
            } catch (Exception $e) {
                $this->_viewRenderer->render('auth/register', ['error' => $e->getMessage()]);
            }
        }
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        session_unset();
        session_destroy();
        
        header('Location: /');
        exit;
    }
}

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
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        $_SESSION['signin'] = true;
        header('Location: ' . $baseUrl . '/');
        exit;
    }

    public function showRegister(): void
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        $_SESSION['signup'] = true;
        header('Location: ' . $baseUrl . '/');
        exit;
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                $user = $this->_loginUseCase->execute($email, $password);
                
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['useremail'] = $user->getEmail();
                $_SESSION['userimage'] = $user->getUserImage();
                $_SESSION['loggedin'] = true;

                $baseUrl = defined('BASE_URL') ? BASE_URL : '';
                header('Location: ' . $baseUrl . '/');
                exit;
            } catch (Exception $e) {
                $baseUrl = defined('BASE_URL') ? BASE_URL : '';
                $_SESSION['signin'] = true;
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => $e->getMessage()
                ];
                header('Location: ' . $baseUrl . '/');
                exit;
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
                $baseUrl = defined('BASE_URL') ? BASE_URL : '';
                $_SESSION['signup'] = true;
                $_SESSION['alert'] = [
                    'type' => 'warning',
                    'message' => 'Las contraseñas no coinciden'
                ];
                header('Location: ' . $baseUrl . '/');
                return;
            }

            try {
                $success = $this->_registerUseCase->execute($username, $email, $password);
                if ($success) {
                    $baseUrl = defined('BASE_URL') ? BASE_URL : '';
                    $_SESSION['signin'] = true;
                    $_SESSION['alert'] = [
                        'type' => 'success',
                        'message' => 'Registro exitoso. Ya puedes iniciar sesion.'
                    ];
                    header('Location: ' . $baseUrl . '/');
                    exit;
                } else {
                    $baseUrl = defined('BASE_URL') ? BASE_URL : '';
                    $_SESSION['signup'] = true;
                    $_SESSION['alert'] = [
                        'type' => 'warning',
                        'message' => 'No se pudo registrar el usuario.'
                    ];
                    header('Location: ' . $baseUrl . '/');
                    exit;
                }
            } catch (Exception $e) {
                $baseUrl = defined('BASE_URL') ? BASE_URL : '';
                $_SESSION['signup'] = true;
                $_SESSION['alert'] = [
                    'type' => 'warning',
                    'message' => $e->getMessage()
                ];
                header('Location: ' . $baseUrl . '/');
                exit;
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
        
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        header('Location: ' . $baseUrl . '/');
        exit;
    }
}

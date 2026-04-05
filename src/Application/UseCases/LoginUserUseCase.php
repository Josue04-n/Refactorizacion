<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Exception;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\UserRepositoryInterface;

class LoginUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $email, string $password): int
    {
        // Buscamos al usuario por su email en el repositorio
        $user = $this->repository->findByEmail($email);

        if (!$user) {
            throw new Exception("Credenciales incorrectas: Usuario no encontrado.");
        }

        // Comprobamos la contraseña plana contra el hash almacenado
        if (!password_verify($password, $user->getPasswordHash())) {
            throw new Exception("Credenciales incorrectas: Contraseña inválida.");
        }

        // Si es correcta, retorna el ID de usuario para iniciar la sesión
        return $user->getId();
    }
}

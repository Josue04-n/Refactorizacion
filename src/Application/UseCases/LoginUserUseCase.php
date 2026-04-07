<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Exception;
use Lenovo\ProyectoRefactorizacion\Domain\Entities\User;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\UserRepositoryInterface;

class LoginUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $email, string $password): User
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

        // Si es correcta, retorna la entidad completa del usuario
        return $user;
    }
}

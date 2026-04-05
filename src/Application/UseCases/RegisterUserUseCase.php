<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\User;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\UserRepositoryInterface;

class RegisterUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $username, string $email, string $password): bool
    {
        // Usamos la función nativa password_hash de PHP para encriptar
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Creamos la entidad pura de User asegurando también el nombre de usuario
        $user = new User($username, $email, $passwordHash);

        return $this->repository->save($user);
    }
}

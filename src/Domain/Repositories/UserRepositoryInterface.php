<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Repositories;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function save(User $user): bool;

    public function findByEmail(string $email): ?User;
}

<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence;

use PDO;
use Exception;
use Lenovo\ProyectoRefactorizacion\Domain\Entities\User;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\UserRepositoryInterface;

class MySQLUserRepository implements UserRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): bool
    {
        try {
            // Asumiendo tabla "users" con columnas: user_email, password, timestamp
            $sql = "INSERT INTO users (user_email, password, timestamp) VALUES (:email, :password, current_timestamp())";
            $stmt = $this->connection->prepare($sql);
            
            $email = $user->getEmail();
            $hash = $user->getPasswordHash();

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hash, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (Exception $e) {
            // Log o manejo de errores
            return false;
        }
    }

    public function findByEmail(string $email): ?User
    {
        try {
            $sql = "SELECT id, user_email, password, timestamp FROM users WHERE user_email = :email LIMIT 1";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            return new User(
                $row['user_email'],
                $row['password'],
                (int) $row['id'],
                $row['timestamp']
            );

        } catch (Exception $e) {
            // Log o manejo de errores
            return null;
        }
    }
}

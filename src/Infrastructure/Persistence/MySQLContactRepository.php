<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Contact;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\ContactRepositoryInterface;
use PDO;
use PDOException;
use RuntimeException;

class MySQLContactRepository implements ContactRepositoryInterface
{
    private PDO $_connection;

    public function __construct(PDO $connection)
    {
        $this->_connection = $connection;
    }

    public function save(Contact $contact): bool
    {
        try {
            $query = "INSERT INTO messages (user_id, username, email, contact, message) 
                      VALUES (:userId, :username, :email, :contactPhone, :message)";
            
            $statement = $this->_connection->prepare($query);
            
            $userId = $contact->getUserId();
            $username = $contact->getUsername();
            $email = $contact->getEmail();
            $contactPhone = $contact->getContactPhone();
            $message = $contact->getMessage();

            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':contactPhone', $contactPhone, PDO::PARAM_STR);
            $statement->bindParam(':message', $message, PDO::PARAM_STR);
            
            return $statement->execute();

        } catch (PDOException $exception) {
            throw new RuntimeException("Error al guardar el mensaje de contacto en la base de datos.");
        }
    }
}
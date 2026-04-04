<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\ThreadRepositoryInterface;
use PDO;
use PDOException;
use RuntimeException;

class MySQLThreadRepository implements ThreadRepositoryInterface
{
    private PDO $_connection;

    public function __construct(PDO $connection)
    {
        $this->_connection = $connection;
    }

    /**
     * Obtiene todos los hilos filtrados por el ID de la categoría.
     *
     * @param int $categoryId
     * @return array<Thread>
     */
    public function getByCategoryId(int $categoryId): array
    {
        try {
            // Se consultan las columnas persistidas en la tabla threads
            $query = "SELECT threads_id, threads_title, threads_desc, threads_cat_id, threads_user_id, threads_reg_date
                      FROM threads 
                      WHERE threads_cat_id = :categoryId";
            
            $statement = $this->_connection->prepare($query);
            $statement->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $statement->execute();
            
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $threads = [];

            foreach ($results as $row) {
                $threads[] = new Thread(
                    (int) $row['threads_id'],
                    $row['threads_title'],
                    $row['threads_desc'],
                    (int) $row['threads_cat_id'],
                    (int) $row['threads_user_id'],
                    $row['threads_reg_date']
                );
            }

            return $threads;

        } catch (PDOException $exception) {
            throw new RuntimeException("Error al obtener los hilos de la base de datos.");
        }
    }
}
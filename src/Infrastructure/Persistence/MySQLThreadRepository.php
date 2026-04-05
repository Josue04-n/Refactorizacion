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

    public function search(string $keyword): array
    {
        try {
            $query = "SELECT threads_id, threads_title, threads_desc, threads_cat_id, threads_user_id, threads_reg_date 
                      FROM threads 
                      WHERE threads_title LIKE :titleKeyword OR threads_desc LIKE :descKeyword";
            
            $statement = $this->_connection->prepare($query);
            
            // Envolvemos la palabra clave con % para la búsqueda LIKE
            $searchTerm = '%' . $keyword . '%';
            $statement->bindValue(':titleKeyword', $searchTerm, PDO::PARAM_STR);
            $statement->bindValue(':descKeyword', $searchTerm, PDO::PARAM_STR);
            
            $statement->execute();
            
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $threads = [];

            // Data Mapper: Convertimos las filas a objetos Thread
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
            throw new RuntimeException("Error al buscar hilos en la base de datos.");
        }
    }
    
    /**
     * Guarda un hilo en la base de datos.
     * @param Thread $thread
     * @return bool
     */
    public function save(Thread $thread): bool
    {
        try {
            $query = "INSERT INTO threads (threads_title, threads_desc, threads_cat_id, threads_user_id, threads_reg_date) VALUES (:title, :description, :categoryId, :userId, :timestamp)";
            $statement = $this->_connection->prepare($query);
            $title = $thread->getTitle();
            $description = $thread->getDescription();
            $categoryId = $thread->getCategoryId();
            $userId = $thread->getUserId();
            $timestamp = $thread->getTimestamp();
            $statement->bindParam(':title', $title, PDO::PARAM_STR);
            $statement->bindParam(':description', $description, PDO::PARAM_STR);
            $statement->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $exception) {
            throw new RuntimeException("Error al guardar el hilo en la base de datos.", (int) $exception->getCode(), $exception);
        }
    }
}
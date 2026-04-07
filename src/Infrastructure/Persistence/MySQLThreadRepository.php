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

    public function getById(int $threadId): ?Thread
    {
        try {
            $query = "SELECT t.threads_id, t.threads_title, t.threads_desc, t.threads_cat_id, t.threads_user_id, t.threads_reg_date,
                             u.username, u.user_image
                      FROM threads t
                      LEFT JOIN users u ON u.id = t.threads_user_id
                      WHERE t.threads_id = :threadId
                      LIMIT 1";

            $statement = $this->_connection->prepare($query);
            $statement->bindParam(':threadId', $threadId, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            return new Thread(
                (int) $row['threads_id'],
                $row['threads_title'],
                $row['threads_desc'],
                (int) $row['threads_cat_id'],
                (int) $row['threads_user_id'],
                $row['threads_reg_date'],
                0,
                (string) ($row['username'] ?? ''),
                (string) ($row['user_image'] ?? '')
            );
        } catch (PDOException $exception) {
            throw new RuntimeException("Error al obtener el hilo de la base de datos.", (int) $exception->getCode(), $exception);
        }
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
                 $query = "SELECT t.threads_id, t.threads_title, t.threads_desc, 
                         t.threads_cat_id, t.threads_user_id, t.threads_reg_date,
                         u.username, u.user_image,
                             COUNT(c.comment_id) AS reply_count
                      FROM threads t
                     LEFT JOIN users u ON u.id = t.threads_user_id
                      LEFT JOIN comments c ON t.threads_id = c.thread_id
                      WHERE t.threads_cat_id = :categoryId
                      GROUP BY t.threads_id, t.threads_title, t.threads_desc, 
                           t.threads_cat_id, t.threads_user_id, t.threads_reg_date,
                           u.username, u.user_image
                      ORDER BY t.threads_reg_date DESC";
            
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
                    $row['threads_reg_date'],
                    (int) $row['reply_count'],
                    (string) ($row['username'] ?? ''),
                    (string) ($row['user_image'] ?? '')
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
            $normalizedKeyword = trim($keyword);

            if ($normalizedKeyword === '') {
                return [];
            }

            $terms = preg_split('/\s+/', $normalizedKeyword) ?: [];
            $termClauses = [];
            $params = [];

            foreach ($terms as $index => $term) {
                $currentTerm = trim($term);

                if ($currentTerm === '') {
                    continue;
                }

                $variants = [$currentTerm];

                // Variacion simple singular/plural para mejorar coincidencias en espanol.
                if (strlen($currentTerm) > 3 && substr($currentTerm, -1) === 's') {
                    $variants[] = substr($currentTerm, 0, -1);
                }

                $variantClauses = [];

                foreach (array_values(array_unique($variants)) as $variantIndex => $variant) {
                    $titleParamName = ':title_term_' . $index . '_' . $variantIndex;
                    $descParamName = ':desc_term_' . $index . '_' . $variantIndex;
                    $variantClauses[] = "threads_title LIKE {$titleParamName} OR threads_desc LIKE {$descParamName}";
                    $params[$titleParamName] = '%' . $variant . '%';
                    $params[$descParamName] = '%' . $variant . '%';
                }

                if (!empty($variantClauses)) {
                    $termClauses[] = '(' . implode(' OR ', $variantClauses) . ')';
                }
            }

            if (empty($termClauses)) {
                return [];
            }

                 $query = "SELECT t.threads_id, t.threads_title, t.threads_desc, t.threads_cat_id, t.threads_user_id, t.threads_reg_date,
                         u.username, u.user_image
                     FROM threads t
                     LEFT JOIN users u ON u.id = t.threads_user_id
                      WHERE " . implode(' AND ', $termClauses);

            $statement = $this->_connection->prepare($query);

            foreach ($params as $paramName => $paramValue) {
                $statement->bindValue($paramName, $paramValue, PDO::PARAM_STR);
            }
            
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
                    $row['threads_reg_date'],
                    0,
                    (string) ($row['username'] ?? ''),
                    (string) ($row['user_image'] ?? '')
                );
            }

            return $threads;

        } catch (PDOException $exception) {
            throw new RuntimeException("Error al buscar hilos en la base de datos.", (int) $exception->getCode(), $exception);
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
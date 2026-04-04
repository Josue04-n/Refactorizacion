<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Comment;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\CommentRepositoryInterface;
use PDO;
use PDOException;
use RuntimeException;

class MySQLCommentRepository implements CommentRepositoryInterface
{
    private PDO $_connection;

    public function __construct(PDO $connection)
    {
        $this->_connection = $connection;
    }

    /**
     * Obtiene todos los comentarios filtrados por el ID del hilo.
     *
     * @param int $threadId
     * @return array<Comment>
     */
    public function getByThreadId(int $threadId): array
    {
        try {
            $query = "SELECT active, comment_by, comment_content, comment_date, comment_id, comment_on_id, thread_id
                      FROM comments 
                      WHERE thread_id = :threadId";
            
            $statement = $this->_connection->prepare($query);
            $statement->bindParam(':threadId', $threadId, PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $comments = [];

            foreach ($results as $row) {
                $comments[] = new Comment(
                    (int) $row['active'],
                    $row['comment_by'],
                    (int) $row['comment_content'],
                    (int) $row['comment_date'],
                    $row['comment_id'],
                    (int) $row['comment_on_id'],
                    (int) $row['thread_id']
                );
            }

            return $comments;

        } catch (PDOException $exception) {
            throw new RuntimeException("Error al obtener los comentarios de la base de datos.");
        }
    }
}
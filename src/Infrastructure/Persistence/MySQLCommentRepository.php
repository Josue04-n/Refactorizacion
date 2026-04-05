    /**
     * Guarda un comentario en la base de datos.
     * @param Comment $comment
     * @return bool
     */
    public function save(Comment $comment): bool
    {
        try {
            $query = "INSERT INTO comments (comment_content, thread_id, comment_by, comment_date) VALUES (:content, :threadId, :userId, :timestamp)";
            $statement = $this->_connection->prepare($query);
            $content = $comment->getContent();
            $threadId = $comment->getThreadId();
            $userId = $comment->getUserId();
            $timestamp = $comment->getTimestamp();
            $statement->bindParam(':content', $content, PDO::PARAM_STR);
            $statement->bindParam(':threadId', $threadId, PDO::PARAM_INT);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $exception) {
            throw new RuntimeException(
                "Error al guardar el comentario en la base de datos.",
                (int) $exception->getCode(),
                $exception
            );
        }
    }
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
            throw new RuntimeException(
                "Error al obtener los comentarios de la base de datos.",
                (int) $exception->getCode(),
                $exception
            );
        }
    }

    /**
     * Guarda un comentario en la base de datos.
     * @param Comment $comment
     * @return bool
     */
    public function save(Comment $comment): bool
    {
        try {
            $query = "INSERT INTO comments (comment_content, thread_id, comment_by, comment_date) VALUES (:content, :threadId, :userId, :timestamp)";
            $statement = $this->_connection->prepare($query);
            $content = $comment->getContent();
            $threadId = $comment->getThreadId();
            $userId = $comment->getUserId();
            $timestamp = $comment->getTimestamp();
            $statement->bindParam(':content', $content, PDO::PARAM_STR);
            $statement->bindParam(':threadId', $threadId, PDO::PARAM_INT);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $exception) {
            throw new RuntimeException(
                "Error al guardar el comentario en la base de datos.",
                (int) $exception->getCode(),
                $exception
            );
        }
    }
}
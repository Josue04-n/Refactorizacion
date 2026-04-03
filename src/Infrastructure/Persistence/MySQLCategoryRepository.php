<?php

declare(strict_types=1);
namespace Lenovo\ProyectoRefactorizacion\Infrastructure\Persistence;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Category;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\CategoryRepositoryInterface;
use PDO;
use PDOException;
use RuntimeException;

    class MySQLCategoryRepository implements CategoryRepositoryInterface
    {
        private PDO $_connection;

        public function __construct(PDO $connection)
        {
            $this->_connection = $connection;
        }

    /**
     * Obtiene todas las categorías de la base de datos.
     *
     * @return array<Category>
     */

        public function getAll(): array {
            try {
                $query = "SELECT category_id, category_name, category_description, created FROM categories";
                $statement = $this->_connection->prepare($query);
                $statement->execute();
                
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $categories = [];

                foreach ($results as $row) {
                    $categories[] = new Category(
                        (int) $row['category_id'],
                        $row['category_name'],
                        $row['category_description'],
                        $row['created']
                    );
                }
                return $categories;

            } catch (PDOException $exception) {
                throw new RuntimeException('Error al obtener las categorías: ' . $exception->getMessage());
            }
        }
    
    }

?>
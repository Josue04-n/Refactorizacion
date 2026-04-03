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
                $query = "SELECT c_id, c_name, c_desc, c_images FROM categories";
                $statement = $this->_connection->prepare($query);
                $statement->execute();
                
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                $categories = [];

                foreach ($results as $row) {
                    $categories[] = new Category(
                        (int) $row['c_id'],
                        $row['c_name'],
                        $row['c_desc'],
                        $row['c_images']
                    );
                }
                return $categories;

            } catch (PDOException $exception) {
                throw new RuntimeException('Error al obtener las categorías.', (int) $exception->getCode(), $exception);
            }
        }
    
    }

?>
<?php
    declare(strict_types=1);
    namespace Lenovo\ProyectoRefactorizacion\Presentation\Controllers;
    use Lenovo\ProyectoRefactorizacion\Infrastructure\Database\DatabaseConnection;
    
    class CategoryController
    {
        public function index() {
            echo "Mostrando todas las categorías";
        }

        public function show(string $id): void {
            echo "Mostrando detalles de la categoría con ID: " . $id;
        }
    }
?>
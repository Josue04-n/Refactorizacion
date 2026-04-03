<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Entities;

    class Category
    {
        private int $_id;
        private string $_name;
        private string $_description;
        private string $_created;

        public function __construct(int $id, string $name, string $description, string $created = '')
        {
            $this->_id = $id;
            $this->_name = $name;
            $this->_description = $description;
            $this->_created = $created ?: date('Y-m-d H:i:s');
        }

        public function getId(): int
        {
            return $this->_id;
        }

        public function getName(): string
        {
            return $this->_name;
        }

        public function getDescription(): string
        {
            return $this->_description;
        }

        public function getCreated(): string
        {
            return $this->_created;
        }
    }

?>
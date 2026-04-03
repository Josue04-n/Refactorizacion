<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Entities;

    class Category
    {
        private int $_id;
        private string $_name;
        private string $_description;
        private string $_images;

        public function __construct(int $id, string $name, string $description, string $images = '')
        {
            $this->_id = $id;
            $this->_name = $name;
            $this->_description = $description;
            $this->_images = $images;
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

        public function getImages(): string
        {
            return $this->_images;
        }
    }

?>
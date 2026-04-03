<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Lenovo\ProyectoRefactorizacion\Domain\Repositories\CategoryRepositoryInterface;

class GetCategoriesUseCase
{
    private CategoryRepositoryInterface $_categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->_categoryRepository = $categoryRepository;
    }

    /**
     * Ejecuta el caso de uso para obtener todas las categorías.
     *
     * @return array<\Lenovo\ProyectoRefactorizacion\Domain\Entities\Category>
     */
    
    public function execute(): array
    {
        return $this->_categoryRepository->getAll();
    }

}

<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\ThreadRepositoryInterface;

class GetThreadByIdUseCase
{
    private readonly ThreadRepositoryInterface $_threadRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository)
    {
        $this->_threadRepository = $threadRepository;
    }

    public function execute(int $threadId): ?Thread
    {
        return $this->_threadRepository->getById($threadId);
    }
}

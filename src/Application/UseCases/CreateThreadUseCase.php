<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Thread;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\ThreadRepositoryInterface;

class CreateThreadUseCase
{
    private readonly ThreadRepositoryInterface $_threadRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository)
    {
        $this->_threadRepository = $threadRepository;
    }

    public function execute(string $title, string $description, int $categoryId, int $userId): void
    {
        $thread = new Thread(
            0,
            $title,
            $description,
            $categoryId,
            $userId,
            date('Y-m-d H:i:s')
        );

        $this->_threadRepository->save($thread);
    }
}
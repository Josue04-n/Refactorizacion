<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Application\UseCases;

use Lenovo\ProyectoRefactorizacion\Domain\Entities\Contact;
use Lenovo\ProyectoRefactorizacion\Domain\Repositories\ContactRepositoryInterface;
use InvalidArgumentException;

class SaveContactMessageUseCase
{
    private ContactRepositoryInterface $_contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->_contactRepository = $contactRepository;
    }

    public function execute(int $userId, string $username, string $email, string $contactPhone, string $message): void
    {
        if (empty($username) || empty($email) || empty($contactPhone) || empty($message)) {
            throw new InvalidArgumentException("Todos los campos son obligatorios.");
        }

        $contact = new Contact($userId, $username, $email, $contactPhone, $message);
        $this->_contactRepository->save($contact);
    }
}
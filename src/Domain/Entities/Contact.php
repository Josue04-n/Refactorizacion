<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Entities;

class Contact
{
    private ?int $_id;
    private int $_userId;
    private string $_username;
    private string $_email;
    private string $_contactPhone;
    private string $_message;

    public function __construct(
        int $userId,
        string $username,
        string $email,
        string $contactPhone,
        string $message,
        ?int $id = null
    ) {
        $this->_userId = $userId;
        $this->_username = $username;
        $this->_email = $email;
        $this->_contactPhone = $contactPhone;
        $this->_message = $message;
        $this->_id = $id;
    }

    public function getId(): ?int { return $this->_id; }
    public function getUserId(): int { return $this->_userId; }
    public function getUsername(): string { return $this->_username; }
    public function getEmail(): string { return $this->_email; }
    public function getContactPhone(): string { return $this->_contactPhone; }
    public function getMessage(): string { return $this->_message; }
}
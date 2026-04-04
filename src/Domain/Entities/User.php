<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Entities;

class User
{
    private ?int $_id;
    private string $_email;
    private string $_passwordHash;
    private ?string $_timestamp;

    public function __construct(
        string $email,
        string $passwordHash,
        ?int $id = null,
        ?string $timestamp = null
    ) {
        $this->_email = $email;
        $this->_passwordHash = $passwordHash;
        $this->_id = $id;
        $this->_timestamp = $timestamp;
    }

    public function getId(): ?int
    {
        return $this->_id;
    }

    public function getEmail(): string
    {
        return $this->_email;
    }

    public function getPasswordHash(): string
    {
        return $this->_passwordHash;
    }

    public function getTimestamp(): ?string
    {
        return $this->_timestamp;
    }
}

<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Entities;

class User
{
    private ?int $_id;
    private string $_username;
    private string $_email;
    private string $_passwordHash;
    private string $_userImage;
    private ?string $_timestamp;

    public function __construct(
        string $username,
        string $email,
        string $passwordHash,
        string $userImage = 'default.png',
        ?int $id = null,
        ?string $timestamp = null
    ) {
        $this->_username = $username;
        $this->_email = $email;
        $this->_passwordHash = $passwordHash;
        $this->_userImage = $userImage;
        $this->_id = $id;
        $this->_timestamp = $timestamp;
    }

    public function getId(): ?int
    {
        return $this->_id;
    }

    public function getUsername(): string
    {
        return $this->_username;
    }

    public function getEmail(): string
    {
        return $this->_email;
    }

    public function getPasswordHash(): string
    {
        return $this->_passwordHash;
    }

    public function getUserImage(): string
    {
        return $this->_userImage;
    }

    public function getTimestamp(): ?string
    {
        return $this->_timestamp;
    }
}

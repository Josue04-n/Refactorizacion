<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Entities;

class Thread
{
    private int $_id;
    private string $_title;
    private string $_description;
    private int $_categoryId;
    private int $_userId;
    private string $_timestamp;
    private int $_replyCount;

    public function __construct(
        int $id, 
        string $title, 
        string $description, 
        int $categoryId, 
        int $userId, 
        string $timestamp,
        int $replyCount = 0
    ) {
        $this->_id = $id;
        $this->_title = $title;
        $this->_description = $description;
        $this->_categoryId = $categoryId;
        $this->_userId = $userId;
        $this->_replyCount = $replyCount;
        $this->_timestamp = $timestamp;
    }

    public function getId(): int
    {
        return $this->_id;
    }

    public function getTitle(): string
    {
        return $this->_title;
    }

    public function getDescription(): string
    {
        return $this->_description;
    }

    public function getCategoryId(): int
    {
        return $this->_categoryId;
    }

    public function getUserId(): int
    {
        return $this->_userId;
    }

    public function getTimestamp(): string
    {
        return $this->_timestamp;
    }

    public function getReplyCount(): int 
    { 
        return $this->_replyCount; 
    }
}
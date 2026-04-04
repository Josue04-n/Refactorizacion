<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Domain\Entities;

class Comment {

    private int $_id;
    private string $_content;
    private int $_threadId;
    private int $_userId;
    private string $_timestamp;

    public function __construct(
        int $id,
        string $content,
        int $threadId,
        int $userId,
        string $timestamp
    ) {
        $this->_id = $id;
        $this->_content = $content;
        $this->_threadId = $threadId;
        $this->_userId = $userId;
        $this->_timestamp = $timestamp;
    }

    public function getId(): int {
        return $this->_id;
    }

    public function getContent(): string {
        return $this->_content;
    }

    public function getThreadId(): int {
        return $this->_threadId;
    }

    public function getUserId(): int {
        return $this->_userId;
    }

    public function getTimestamp(): string {
        return $this->_timestamp;
    }
}



?>
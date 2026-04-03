<?php

declare(strict_types=1);

namespace Lenovo\ProyectoRefactorizacion\Infrastructure\Database;

use PDO;
use PDOException;
use RuntimeException;

class DatabaseConnection
{
    private ?PDO $_connection = null;
    
    private string $_host;
    private string $_database;
    private string $_username;
    private string $_password;

    public function __construct(string $host, string $database, string $username, string $password)
    {
        $this->_host = $host;
        $this->_database = $database;
        $this->_username = $username;
        $this->_password = $password;
    }

    public function connect(): PDO
    {
        if ($this->_connection === null) {
            try {
                $dataSourceName = "mysql:host={$this->_host};dbname={$this->_database};charset=utf8mb4";
                
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                $this->_connection = new PDO($dataSourceName, $this->_username, $this->_password, $options);
                
            } catch (PDOException $exception) {
                throw new RuntimeException($exception->getMessage());
            }
        }

        return $this->_connection;
    }
}
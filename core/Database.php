<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config)
    {
        try {
            $dsn = "mysql:" . http_build_query($config, '', ';');
            $this->connection = new PDO(
                $dsn,
                options: [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new \Exception("Database connection failed. Please check your configuration.");
        }
    }

    /**
     * Execute query with parameters for prepared statements
     */
    public function query($query, $params = []): self
    {
        try {
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);
        } catch (PDOException $e) {
            error_log("Query execution failed: " . $e->getMessage());
            error_log("Query: " . $query);
            throw new \Exception("Query execution failed: " . $e->getMessage());
        }

        return $this;
    }

    /**
     * Fetch all results
     */
    public function get(): array
    {
        return $this->statement->fetchAll() ?: [];
    }

    /**
     * Fetch single result
     */
    public function find(): ?array
    {
        $result = $this->statement->fetch();
        return $result ?: null;
    }

    /**
     * Fetch single result or throw exception
     */
    public function findOrFail(): array
    {
        $result = $this->find();

        if (!$result) {
            throw new \Exception("Record not found");
        }

        return $result;
    }

    /**
     * Get connection for direct access if needed
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}


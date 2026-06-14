<?php

namespace Core;

use PDO;

/**
 * DatabaseService - Wrapper around Database for common operations with error handling
 */
class DatabaseService
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Get database connection
     */
    public function getConnection(): Database
    {
        return $this->database;
    }

    /**
     * Find record by ID with error handling
     */
    public function findById(string $table, int $id): ?array
    {
        try {
            return $this->database
                ->query("SELECT * FROM {$table} WHERE id = :id", ['id' => $id])
                ->find();
        } catch (\Exception $e) {
            error_log("Database error fetching {$table} id {$id}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get all records with optional conditions
     */
    public function getAll(string $table, array $conditions = [], string $orderBy = 'id DESC'): array
    {
        try {
            $where = empty($conditions) ? '1 = 1' : implode(' AND ', array_keys($conditions));
            return $this->database
                ->query("SELECT * FROM {$table} WHERE {$where} ORDER BY {$orderBy}", $conditions)
                ->get();
        } catch (\Exception $e) {
            error_log("Database error fetching from {$table}: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Insert record with validation
     */
    public function insert(string $table, array $data): ?int
    {
        if (empty($data)) {
            throw new \InvalidArgumentException("Cannot insert empty data");
        }

        try {
            $columns = array_keys($data);
            $placeholders = implode(',', array_map(fn($col) => ":{$col}", $columns));
            $columnList = implode(',', $columns);

            $this->database->query(
                "INSERT INTO {$table} ({$columnList}) VALUES ({$placeholders})",
                $data
            );

            return (int)$this->database->getConnection()->lastInsertId();
        } catch (\Exception $e) {
            error_log("Database insert error in {$table}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Update record with validation
     */
    public function update(string $table, int $id, array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        try {
            $setClause = implode(', ', array_map(fn($col) => "{$col} = :{$col}", array_keys($data)));
            $data['id'] = $id;

            $this->database->query(
                "UPDATE {$table} SET {$setClause} WHERE id = :id",
                $data
            );

            return true;
        } catch (\Exception $e) {
            error_log("Database update error in {$table}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete record
     */
    public function delete(string $table, int $id): bool
    {
        try {
            $this->database->query("DELETE FROM {$table} WHERE id = :id", ['id' => $id]);
            return true;
        } catch (\Exception $e) {
            error_log("Database delete error in {$table}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Execute raw query with error handling
     */
    public function query(string $sql, array $params = []): array
    {
        try {
            return $this->database->query($sql, $params)->get();
        } catch (\Exception $e) {
            error_log("Database query error: " . $e->getMessage());
            return [];
        }
    }
}

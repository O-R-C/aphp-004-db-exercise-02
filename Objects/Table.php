<?php

declare(strict_types=1);

namespace Objects;

use \Interfaces\DatabaseWrapper;
use PDO;

class Table implements DatabaseWrapper
{
  public object $pdo;
  public string $table;
  public array $columns;
  public function __construct(object $pdo, string $table, array $columns)
  {
    $this->pdo = $pdo;
    $this->table = $table;
    $this->columns = $columns;

    $this->createTable();
  }

  private function createTable(): void
  {
    $columns = <<<SQL
      id INTEGER PRIMARY KEY,
      name text NOT NULL,
      email text NOT NULL
    SQL;

    $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->table . ' (' . $columns . ')';

    $this->pdo->exec($sql);
  }

  public function insert(array $tableColumns, array $values): array
  {
    $sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $tableColumns) . ') VALUES (' . implode(', ', array_fill(0, count($tableColumns), '?')) . ')';
    $this->pdo->prepare($sql)->execute($values);

    $data = $this->getQuery('ORDER BY rowid DESC LIMIT 1;');

    return $data ?? [];
  }

  public function update(int $id, array $values): array
  {
    $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', array_map(fn($column) => $column . ' = ?', $this->columns)) . ' WHERE id = ?';
    $this->pdo->prepare($sql)->execute(array_merge($values, [$id]));

    $data = $this->getQuery("WHERE id = $id");

    return $data ?? [];
  }

  public function find(int $id): array
  {
    $data = $this->getQuery("WHERE id = $id");

    if (!$data) {
      return [];
    }

    return $data;
  }

  public function delete(int $id): bool
  {
    $sql = "DELETE FROM $this->table WHERE id = $id";

    return $this->pdo->prepare($sql)->execute();
  }

  public function resetTable(): void
  {
    $this->pdo->exec("DELETE FROM $this->table");

    $this->createTable();
  }

  private function getQuery(string $lastPart): bool | array
  {
    $sql = "SELECT * FROM $this->table $lastPart";

    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
}

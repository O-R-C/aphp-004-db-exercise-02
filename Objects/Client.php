<?php

declare(strict_types=1);

namespace Objects;

class Client extends Table
{
  public function __construct(object $pdo)
  {
    parent::__construct($pdo, 'client', ['name', 'phone']);
  }

  public function createTable(): void
  {
    $columns = <<<SQL
      id INTEGER PRIMARY KEY,
      name text NOT NULL,
      phone text NOT NULL
    SQL;

    $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->table . ' (' . $columns . ')';

    $this->pdo->exec($sql);
  }
}

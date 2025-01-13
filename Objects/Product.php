<?php

declare(strict_types=1);

namespace Objects;

class Product extends Table
{
  public function __construct(object $pdo)
  {
    parent::__construct($pdo, 'product', ['name', 'price', 'count', 'shop_id']);
  }

  public function createTable(): void
  {
    $columns = <<<SQL
      id INTEGER PRIMARY KEY,
      name text NOT NULL,
      price real NOT NULL,
      count INTEGER NOT NULL,
      shop_id INTEGER NOT NULL,
      FOREIGN KEY (shop_id) REFERENCES shop(id)
    SQL;

    $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->table . ' (' . $columns . ')';

    $this->pdo->exec($sql);
  }
}

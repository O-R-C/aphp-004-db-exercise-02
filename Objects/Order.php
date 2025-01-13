<?php

declare(strict_types=1);

namespace Objects;

class Order extends Table
{
  public function __construct(object $pdo)
  {
    parent::__construct($pdo, 'order_table', ['created_at', 'shop_id', 'client_id']);
  }

  public function createTable(): void
  {
    $columns = <<<SQL
      id INTEGER PRIMARY KEY,
      created_at text NOT NULL,
      client_id INTEGER NOT NULL,
      shop_id INTEGER NOT NULL,
      FOREIGN KEY (client_id) REFERENCES client(id),
      FOREIGN KEY (shop_id) REFERENCES shop(id)
    SQL;

    $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->table . ' (' . $columns . ')';

    $this->pdo->exec($sql);
  }
}

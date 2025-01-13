<?php

declare(strict_types=1);

namespace Objects;

class Order_Product extends Table
{
  public function __construct(object $pdo)
  {
    parent::__construct($pdo, 'order_product', ['order_id', 'product_id', 'count']);
  }

  public function createTable(): void
  {
    $columns = <<<SQL
      id INTEGER PRIMARY KEY,
      order_id INTEGER NOT NULL,
      FOREIGN KEY (order_id) REFERENCES order(id),
      product_id INTEGER NOT NULL,
      FOREIGN KEY (product_id) REFERENCES product(id),
      count INTEGER NOT NULL
    SQL;

    $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->table . ' (' . $columns . ')';

    $this->pdo->exec($sql);
  }
}

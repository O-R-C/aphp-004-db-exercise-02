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
      count INTEGER NOT NULL,
      order_id INTEGER NOT NULL,
      product_id INTEGER NOT NULL,
      FOREIGN KEY (order_id) REFERENCES order_table(id),
      FOREIGN KEY (product_id) REFERENCES product(id)
    SQL;

    $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->table . ' (' . $columns . ')';

    $this->pdo->exec($sql);
  }
}

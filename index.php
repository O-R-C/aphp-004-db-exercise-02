<?php

declare(strict_types=1);

require_once './autoload.php';

require_once './insertDataToTable.php';


$pdo = new PDO('sqlite:identifier.sqlite', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$shopsTable = new \Objects\Shop($pdo);
$clientsTable = new \Objects\Client($pdo);
$productsTable = new \Objects\Product($pdo);
$orderTable = new \Objects\Order($pdo);
$ordersProductsTable = new \Objects\Order_Product($pdo);


$insertDataToTable($shopsTable, 'shops');
$insertDataToTable($clientsTable, 'clients');
$insertDataToTable($productsTable, 'products');
$insertDataToTable($orderTable, 'orders');
$insertDataToTable($ordersProductsTable, 'orders_products');


var_dump($shopsTable->update(1, ['Магазин 11', 'Москва, ул. Тверская, 1']));
print("\n");
var_dump($shopsTable->find(2));
print("\n");
var_dump($shopsTable->delete(2));
print("\n");
var_dump($shopsTable->find(2));
print("\n");

var_dump($clientsTable->update(1, ['Димон', '777-77-77']));
print("\n");
var_dump($clientsTable->find(5));
print("\n");

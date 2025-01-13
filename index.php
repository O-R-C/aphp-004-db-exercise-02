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


// $insertDataToTable($orderTable, 'orders');
// $insertDataToTable($ordersProductsTable, 'orders_products');
// $insertDataToTable($clientsTable, 'clients');
// $insertDataToTable($productsTable, 'products');
// $insertDataToTable($shopsTable, 'shops');

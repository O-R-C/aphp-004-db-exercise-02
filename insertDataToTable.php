<?php

declare(strict_types=1);

$orders = require_once './data/tables/orders.php';
$orders_products = require_once './data/tables/orders_products.php';
$clients = require_once './data/tables/clients.php';
$products = require_once './data/tables/products.php';
$shops = require_once './data/tables/shops.php';

$insertData = function (object $table, array $data) {
  $columns = array_keys($data);
  $values = array_values($data);
  $table->insert($columns, $data);
};

$insertOrders = function (object $table) use ($insertData, $orders) {
  foreach ($orders as $order) {
    $insertData($table, $order);
  }
};

$insertOrdersProducts = function (object $table) use ($insertData, $orders_products) {
  foreach ($orders_products as $order_product) {
    $insertData($table, $order_product);
  }
};

$insertClients = function (object $table) use ($insertData, $clients) {
  foreach ($clients as $client) {
    $insertData($table, $client);
  }
};

$insertProducts = function (object $table) use ($insertData, $products) {
  foreach ($products as $product) {
    $insertData($table, $product);
  }
};

$insertShops = function (object $table) use ($insertData, $shops) {
  foreach ($shops as $shop) {
    $insertData($table, $shop);
  }
};


$insertDataToTable = function (object $table, string $dataName) use ($insertOrders, $insertOrdersProducts, $insertClients, $insertProducts, $insertShops) {
  switch ($dataName) {
    case 'orders':
      $insertOrders($table);
      break;
    case 'orders_products':
      $insertOrdersProducts($table);
      break;
    case 'clients':
      $insertClients($table);
      break;
    case 'products':
      $insertProducts($table);
      break;
    case 'shops':
      $insertShops($table);
      break;
    default:
      break;
  }
};

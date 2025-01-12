<?php

declare(strict_types=1);

require_once './autoload.php';


$pdo = new PDO('sqlite:identifier.sqlite', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


$users = new \Objects\Table($pdo, 'users', ['name', 'email']);
$users->resetTable();


$resultInsert = $users->insert(['name', 'email'], ['Petya', '2zP2F@example.com']);
var_dump($resultInsert);

$resultInsert = $users->insert(['name', 'email'], ['Vasya', '2zP2F@example.com']);
var_dump($resultInsert);

$resultUpdate = $users->update(1, ['Petya1', 'aaa@example.com']);
var_dump($resultUpdate);

$resultFind = $users->find(23);
var_dump($resultFind);

$resultDelete = $users->delete(1);
var_dump($resultDelete);

$resultFind = $users->find(1);
var_dump($resultFind);

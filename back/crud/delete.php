<?php

// Require Db class
require_once '../Db.php';

// Get JSON data
$json = file_get_contents('php://input');
$data = json_decode($json);

// Create new Db object and connect to database
$db = new DB();
$json = file_get_contents('php://input');
$data = json_decode($json, 1);

// Delete products from database
foreach ($data['skus'] as $sku) {
    $db->delete($sku);
}
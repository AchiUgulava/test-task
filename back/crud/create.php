<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

// Require classes
require_once '../Product.php';
require_once '../Db.php';

// Get JSON data
$json = file_get_contents('php://input');
$data = json_decode($json, 1);

// Create new Db object and connect to database
$db = new DB();

//check if unique
$unique = $db->find($data['sku']);
if ($unique == 0) {

    // Create new Product object and set its properties
    $product = new Product();
    $product->setSku($data['sku']);
    $product->setName($data['name']);
    $product->setPrice($data['price']);
    $product->setType($data['type']);
    $product->setSize($data['size']);
    $product->setWeight($data['weight']);
    $product->setHeight($data['height']);
    $product->setWidth($data['width']);
    $product->setLength($data['length']);
    // Add product to database
    $db->create($product);
    echo 'success';
} else {
    echo 'SKU not available';
}
return;
<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
include_once('../DVD.php');
include_once('../Book.php');
include_once('../Furniture.php');
include_once('../Database.php');
// Parse JSON request
$data = json_decode(file_get_contents('php://input'), true);
$sku = $data['sku'];
$name = $data['name'];
$price = $data['price'];
$type = $data['type'];
$size = $data['size'];
$weight = $data['weight'];
$length = $data['length'];
$height = $data['height'];
$width = $data['width'];
// Create new product based on type
if ($type === 'Book') {
    $product = new Book($sku, $name, $price, $weight);
} 
else if ($type === 'DVD') {
    $product = new DVD($sku, $name, $price, $size);
}
else if ($type === 'Furniture') {
    $product = new Furniture($sku, $name, $price, $height, $width, $length);
}

// Add product to database
$db = new DB();
$db->addProduct($product);
<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
include_once('../Database.php');
include_once('../BaseProduct.php');
// Parse JSON request
$data = json_decode(file_get_contents('php://input'), true);
$sku = $data['sku'];
$name = $data['name'];
$price = $data['price'];
$type = $data['type'];
$params = [
    'weight' => $data['weight'],
    'size' => $data['size'],
    'height' => $data['height'],
    'width' => $data['width'],
    'length' => $data['length']
];
$base = new BaseProduct($sku, $name, $price, $type);
$product = $base->initByType();
$product->setAllParams($params);
$db = new DB();
$db->addProduct($product);
return;
// return $product;
// Create new product based on type
// if ($type === 'Book') {

//     $weight = $data['weight'];
//     $product = new Book($sku, $name, $price, $weight);
// } else if ($type === 'DVD') {

//     $size = $data['size'];
//     $product = new DVD($sku, $name, $price, $size);
// } else if ($type === 'Furniture') {

//     $length = $data['length'];
//     $height = $data['height'];
//     $width = $data['width'];
//     $product = new Furniture($sku, $name, $price, $height, $width, $length);
// }

// Add product to database
// $db = new DB();
// $db->addProduct($product);
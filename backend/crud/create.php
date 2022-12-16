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
//seperate array for type params
$params = [
    'weight' => $data['weight'],
    'size' => $data['size'],
    'height' => $data['height'],
    'width' => $data['width'],
    'length' => $data['length']
];
//base product instance
$base = new BaseProduct($sku, $name, $price, $type);
//product instance
$product = $base->initByType();
//set params 
$product->setAllParams($params);
//database instance
$db = new DB();
//database query to create product 
$db->addProduct($product);
return;
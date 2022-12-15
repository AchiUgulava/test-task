<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
include_once('../DVD.php');
include_once('../Book.php');
include_once('../Database.php');

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
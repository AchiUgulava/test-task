<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

// Require classes
require_once '../Db.php';

// Get JSON data
// Create new Db object and connect to database
$db = new DB();
$products = $db->read();
echo json_encode($products);
exit;
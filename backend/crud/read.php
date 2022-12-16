<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
include_once('../Database.php');

// Create new database instance
$db = new DB();

// Get all products from database
$result = $db->readAll();
// Return result as JSON
echo json_encode($result);
return;

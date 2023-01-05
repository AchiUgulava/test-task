<?php
require_once '../ProductActions.php';
$product = new ProductActions();
$product->createProduct(file_get_contents('php://input'));
exit;
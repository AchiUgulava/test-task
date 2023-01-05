<?php
require_once '../ProductActions.php';
$products = new ProductActions();
$products->getAllProducts();
exit;
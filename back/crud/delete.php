<?php

require_once '../ProductActions.php';
$products = new ProductActions();
$products->deleteProducts(file_get_contents('php://input'));
return;
<?php

require_once '../Product.php';
require_once '../Db.php';

class ProductActions extends DB
{

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // Methods
    public function createProduct($json)
    {
        $data = json_decode($json, 1);
        $unique = $this->find($data['sku']);
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
            $this->create($product);
            echo '';
        } else {
            echo 'SKU not available';
        }
        return;
    }

    public function deleteProducts($json)
    {
        $data = json_decode($json);
        // Create new Db object and connect to database
        $json = file_get_contents('php://input');
        $data = json_decode($json, 1);

        // Delete products from database
        foreach ($data['skus'] as $sku) {
            $this->delete($sku);
        }
        return;
    }

    public function getAllProducts()
    {
        $products = $this->read();
        echo json_encode($products);
        return;
    }
}
<?php

include('config.php');

include_once('BaseProduct.php');
class DB
{

    //props

    private $dbHost = DB_HOST;
    private $dbUsername = DB_USER;
    private $dbPassword = DB_PASSWORD;
    private $dbName = DB_DATABSE;
    private $pdo;
    //cosntructor

    public function __construct()
    {
        if (!isset($this->pdo)) {

            // Connect to the database 
            try {
                $conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUsername, $this->dbPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $conn;
            } catch (PDOException $e) {
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }

    public function addProduct(Product $product)
    {
        try {
            $query = 'INSERT INTO products (sku, name, price, type) VALUES (?, ?, ?, ?)';
            $params = [$product->getSku(), $product->getName(), $product->getPrice(), $product->getType()];
            $this->pdo->prepare($query)->execute($params);
            //add params to types table 
            $query = $product->getCreateQuery();
            $params = $product->getCreateParams();
            $this->pdo->prepare($query)->execute($params);
        } catch (PDOException $e) {
            echo 'sku not available';
        }
    }
    public function readProductParams(Product $product)
    {
        if ($product) {
                $query = $product->getReadQuery();
                $params = $product->getSku();
                $result = $this->pdo->prepare($query);
                $result->execute([$params]);
                $type_params = $result->fetch(PDO::FETCH_ASSOC);
                $product->setAllParams($type_params);
            $data = $product->getAll();
            return $data;
        }
        return null;
    }
    public function readAll()
    {
        $query = 'SELECT * FROM products';
        $result = $this->pdo->query($query);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        // Loop through each product
        foreach ($products as $product) {
            $base = new BaseProduct($product['sku'],$product['name'], $product['price'], $product['type']);
            $product = $base->initByType();
            $product_data = $this->readProductParams($product);
            // Get additional information for furniture, book or dvd
            // if ($product['type'] === 'Book') {
            //     $query = 'SELECT weight FROM books WHERE sku = ?';
            //     $params = [$product['sku']];
            //     $result = $this->pdo->prepare($query);
            //     $result->execute($params);
            //     $book = $result->fetch(PDO::FETCH_ASSOC);
            //     $product['weight'] = $book['weight'];
            // } else if ($product['type'] === 'DVD') {
            //     $query = 'SELECT size FROM dvds WHERE sku = ?';
            //     $params = [$product['sku']];
            //     $result = $this->pdo->prepare($query);
            //     $result->execute($params);
            //     $dvd = $result->fetch(PDO::FETCH_ASSOC);
            //     $product['size'] = $dvd['size'];
            // } else if ($product['type'] === 'Furniture') {
            //     $query = 'SELECT height, width, length FROM furnitures WHERE sku = ?';
            //     $params = [$product['sku']];
            //     $result = $this->pdo->prepare($query);
            //     $result->execute($params);
            //     $furniture = $result->fetch(PDO::FETCH_ASSOC);
            //     $product['height'] = $furniture['height'];
            //     $product['width'] = $furniture['width'];
            //     $product['length'] = $furniture['length'];
            // }
            // Add product to result array
            array_push($data, $product_data);
        }
        return $data;
    }
    public function delete($sku)
    {
        $query = "DELETE FROM products WHERE sku = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$sku]);
    }
}
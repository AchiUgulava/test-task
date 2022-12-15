<?php

include('config.php');

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
        try{
            $query = 'INSERT INTO products (sku, name, price, type) VALUES (?, ?, ?, ?)';
            $params = [$product->getSku(), $product->getName(), $product->getPrice(), $product->getType()];
            $this->pdo->prepare($query)->execute($params);    
    
        if ($product instanceof Book) {
            $query = 'INSERT INTO books (sku, weight) VALUES (?, ?)';
            $params = [$product->getSku(), $product->getWeight()];
            $this->pdo->prepare($query)->execute($params);
        } else if ($product instanceof DVD) {
            $query = 'INSERT INTO dvds (sku, size) VALUES (?, ?)';
            $params = [$product->getSku(), $product->getSize()];
            $this->pdo->prepare($query)->execute($params);
        } else if ($product instanceof Furniture) {
            $query = 'INSERT INTO furnitures (sku, height, length, width) VALUES (?, ?, ?, ?)';
            $params = [$product->getSku(), $product->getHeight(), $product->getLength(), $product->getWidth()];
            $this->pdo->prepare($query)->execute($params);
        }
    }
    catch(PDOException $e){
        echo 'sku not available';
    }
    }

    // public function readProduct($sku)
    // {
    //     $query = 'SELECT * FROM products WHERE sku = ?';
    //     $params = [$sku];
    //     $result = $this->pdo->prepare($query);
    //     $result->execute([$params]);
    //     $product = $result->fetch(PDO::FETCH_ASSOC);

    //     if ($product) {
    //         if ($product['type'] === 'Book') {
    //             $query = 'SELECT weight FROM books WHERE sku = ?';
    //             $params = [$product['sku']];
    //             $result = $this->pdo->prepare($query);
    //             $result->execute([$params]);
    //             $book = $result->fetch(PDO::FETCH_ASSOC);
    //             return new Book($product['sku'], $product['name'], $product['price'], $book['weight']);
    //         } else if ($product['type'] === 'DVD') {
    //             $query = 'SELECT size FROM dvds WHERE sku = ?';
    //             $params = [$product['sku']];
    //             $result = $this->pdo->prepare($query);
    //             $result->execute([$params]);
    //             $dvd = $result->fetch(PDO::FETCH_ASSOC);
    //             return new DVD($product['sku'], $product['name'], $product['price'], $dvd['size']);
    //         }

    //     }

    //     return null;
    // }
    public function readAll()
    {
        $query = 'SELECT * FROM products';
        $result = $this->pdo->query($query);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        // Loop through each product
        foreach ($products as $product) {
            // Get additional information for book or dvd
            if ($product['type'] === 'Book') {
                $query = 'SELECT weight FROM books WHERE sku = ?';
                $params = [$product['sku']];
                $result = $this->pdo->prepare($query);
                $result->execute($params);
                $book = $result->fetch(PDO::FETCH_ASSOC);
                $product['weight'] = $book['weight'];
            } else if ($product['type'] === 'DVD') {
                $query = 'SELECT size FROM dvds WHERE sku = ?';
                $params = [$product['sku']];
                $result = $this->pdo->prepare($query);
                $result->execute($params);
                $dvd = $result->fetch(PDO::FETCH_ASSOC);
                $product['size'] = $dvd['size'];
            } else if ($product['type'] === 'Furniture') {
                $query = 'SELECT height, width, length FROM furnitures WHERE sku = ?';
                $params = [$product['sku']];
                $result = $this->pdo->prepare($query);
                $result->execute($params);
                $furniture = $result->fetch(PDO::FETCH_ASSOC);
                $product['height'] = $furniture['height'];
                $product['width'] = $furniture['width'];
                $product['length'] = $furniture['length'];
            }
            // Add product to result array
            array_push($data, $product);
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
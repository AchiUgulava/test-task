<?php

include('config.php');

class DB
{

    //props

    private $dbHost = DB_HOST;
    private $dbUsername = DB_USER;
    private $dbPassword = DB_PASSWORD;
    private $dbName = DB_DATABSE;
    private $db;
    //cosntructor

    public function __construct()
    {
        if (!isset($this->db)) {

            // Connect to the database 
            try {
                $conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUsername, $this->dbPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $conn;
            } catch (PDOException $e) {
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }

    // Methods
    public function create($product)
    {
        $query = "INSERT INTO products (sku, name, price, type, size, weight, height, length, width) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getType(),
            $product->getSize(),
            $product->getWeight(),
            $product->getHeight(),
            $product->getLength(),
            $product->getWidth()
        ]);
    }

    public function read()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->db->query($query);
        $products = $stmt->fetchAll();
        return $products;
    }
    public function find($sku)
    {
        $query = "SELECT * FROM products WHERE sku = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$sku]);
        $product = $stmt->fetch();
        return $product;
    }

    public function update($product)
    {
        $query = "UPDATE products SET name = ?, price = ? WHERE sku = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product->getName(), $product->getPrice(), $product->getSku()]);
    }

    public function delete($sku)
    {
        $query = "DELETE FROM products WHERE sku = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$sku]);
    }
}
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
            //prepare and execute query on main table
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
        // recieve product
        if ($product) {
            //get product params query and params
            $query = $product->getReadQuery();
            $params = $product->getSku();
            //retrieve data
            $result = $this->pdo->prepare($query);
            $result->execute([$params]);
            $type_params = $result->fetch(PDO::FETCH_ASSOC);
            //set all params in type
            $product->setAllParams($type_params);
            //retrieve all data as an array
            $data = $product->getAll();
            return $data;
        }
        return null;
    }
    public function readAll()
    {
        // retrieve all product bases
        $query = 'SELECT * FROM products';
        $result = $this->pdo->query($query);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        $data = [];
        // Loop through each product
        foreach ($products as $product) {
            $base = new BaseProduct($product['sku'], $product['name'], $product['price'], $product['type']);
            // initialise product bases
            $product = $base->initByType();
            //use read product method to retrieve all data of a product
            $product_data = $this->readProductParams($product);
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
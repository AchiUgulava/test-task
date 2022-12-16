<?php
include_once('Product.php');
class Book extends Product
{
    protected $weight;

    public function __construct($sku, $name, $price)
    {
        parent::__construct($sku, $name, $price, 'Book');
        // $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getCreateQuery()
    {
        return 'INSERT INTO books (sku, weight) VALUES (?, ?)';
    }
    public function getCreateParams()
    {
       return [$this->getSku(), $this->getWeight()];
   }
   public function getReadQuery()
   {
       return 'SELECT weight FROM books WHERE sku = ?';
   }
   public function getReadParams()
   {
       return [$this->getSku()];
   }
   public function setAllParams($params)
   {
       $this->setWeight($params['weight']);
   }
   public function getAllParams()
   {
       return array('weight' => $this->getWeight());
   }
}
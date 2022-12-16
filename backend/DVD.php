<?php
include_once('Product.php');

class DVD extends Product
{
    protected $size;

    public function __construct($sku, $name, $price)
    {
        parent::__construct($sku, $name, $price, 'DVD');
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }
    public function getCreateQuery()
    {
     return 'INSERT INTO dvds (sku, size) VALUES (?, ?)';
    }
   public function getCreateParams()
   {
    return[$this->getSku(), $this->getSize()];
   }
   public function getReadQuery()
   {
       return 'SELECT size FROM dvds WHERE sku = ?';
   }
   public function getReadParams()
   {
       return;
   }
   public function setAllParams($params)
   {
       $this->setSize($params['size']);
   }
   public function getAllParams()
   {
       return array('size' => $this->getSize());
   }
}
<?php
include_once('Product.php');

class DVD extends Product
{
    protected $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price, 'DVD');
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }
}
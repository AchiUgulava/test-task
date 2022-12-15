<?php
include_once('Product.php');

class Furniture extends Product
{
    protected $height;
    protected $length;
    protected $width;

    public function __construct($sku, $name, $price, $height,$width,$length)
    {
        parent::__construct($sku, $name, $price, 'Furniture');
        $this-> height= $height;
        $this-> length= $length;
        $this-> width= $width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this-> height= $height;
    }
    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this-> width= $width;
    }
    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this-> length= $length;
    }

}
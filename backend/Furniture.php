<?php
include_once('Product.php');

class Furniture extends Product
{
    protected $height;
    protected $length;
    protected $width;

    public function __construct($sku, $name, $price)
    {
        parent::__construct($sku, $name, $price, 'Furniture');
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }
    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }
    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getCreateQuery()
    {
        return 'INSERT INTO furnitures (sku, height, length, width) VALUES (?, ?, ?, ?)';
    }
    public function getCreateParams()
    {
        return [$this->getSku(), $this->getHeight(), $this->getLength(), $this->getWidth()];
    }


    public function getReadQuery()
    {
        return 'SELECT height, width, length FROM furnitures WHERE sku = ?';
    }
    public function getReadParams()
    {
        return;
    }
    public function setAllParams($params)
    {
        $this->setHeight($params['height']);
        $this->setWidth($params['width']);
        $this->setLength($params['length']);
    }
    public function getAllParams()
    {
        return array('height' => $this->getHeight(),'width' => $this->getWidth(),'length' =>$this->getLength());
    }

}
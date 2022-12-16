<?php
include_once('Product.php');
include_once('../DVD.php');
include_once('../Book.php');
include_once('../Furniture.php');
class BaseProduct extends Product
{

    public function __construct($sku, $name, $price, $type)
    {
        parent::__construct($sku, $name, $price, $type);
    }

    public function initByType()
    {
        if ($this->type === 'Book') {
            return new Book($this->sku, $this->name, $this->price);
        } else if ($this->type === 'DVD') {

            return new DVD($this->sku, $this->name, $this->price);
        } else if ($this->type === 'Furniture') {

            return new Furniture($this->sku, $this->name, $this->price);
        }
    }
    public function getCreateQuery()
    {
        return;
    }
    public function getCreateParams()
    {
        return [$this->getSku()];
    }
    public function setParamsByType()
    {

    }
    public function getReadQuery()
    {
        return;
    }
    public function getReadParams()
    {
        return;
    }
    public function setAllParams($params)
    {
        return;
    }
    public function getAllParams()
    {
        return;
    }

}
<?php

class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    public function __construct($sku, $name, $price, $type)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

}

class Book extends Product
{
    protected $weight;

    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price, "book");
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getDescription()
    {
        return "This book has a SKU of " . $this->getSKU() . ", a name of " . $this->getName() . ", a price of " . $this->getPrice() . ", a weight of " . $this->getWeight() . " and a type of " . $this->getType() . ".";
    }
}

class DVD extends Product
{
    protected $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price, "dvd");
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

    public function getDescription()
    {
        return "This DVD has a SKU of " . $this->getSKU() . ", a name of " . $this->getName() . ", a price of " . $this->getPrice() . ", a size of " . $this->getSize() . " and a type of " . $this->getType() . ".";
    }
}

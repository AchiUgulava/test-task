<?php

abstract class Product
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

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
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
    public function getall(){
        $base = array('sku' => $this->getSku(),'name' => $this->getName(),'price' =>$this->getPrice(),'type' => $this->getType());
        $params = $this->getAllParams();
        return array_merge($base, $params);
    }
    //methods for create
    abstract public function getCreateQuery();
    abstract public function getCreateParams();
    //methods for read
    abstract public function getReadQuery();
    abstract public function getReadParams();
    abstract public function setAllParams($params);
    abstract public function getAllParams();
}

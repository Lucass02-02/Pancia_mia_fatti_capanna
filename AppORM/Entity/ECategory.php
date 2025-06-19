<?php

class ECategoty {

    //attributes
    
    private $name;

    private array $products;


    //constructor

    public function __construct($name, array $products = []) {
        $this->name = $name;
        $this->products = $products;
    }

    //methods getters and setters

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getProducts() {
        return $this->products;
    }

    public function setProducts(array $products) {
        $this->products = $products;
    }
}
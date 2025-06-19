<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
class EProduct {

    //attributes

    private $name;

    private $description;

    private $cost;

    //constructor
    public function __construct($name, $description, $cost) {
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
    }   

    //methods getters and setters

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCost() {
        return $this->cost;
    }

    public function setCost($cost) {
        $this->cost = $cost;
    }

    
}
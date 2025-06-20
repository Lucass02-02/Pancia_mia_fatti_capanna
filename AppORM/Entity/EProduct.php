<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;

enum ProductCategory: string {
    case ANTIPASTO = 'antipasto';
    case PRIMO = 'primo';
    case SECONDO = 'secondo';
    case CONTORNO = 'contorno';
    case DOLCE = 'dolce';
    case BEVANDA = 'bevanda';
}

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class EProduct {

    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $idProduct;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: false)] 
    private $description;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: false)]
    private $cost;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private $availability;

    #[ORM\Column(type: 'string', length: 50, nullable: false, enumType: ProductCategory::class)]
    private ProductCategory $category;

    //constructor
    public function __construct($name, $description, $cost, ProductCategory $category) {
        $this->category = $category;
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
    }   

    //methods getters and setters

    public function getIdProduct() {
        return $this->idProduct;
    }

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

    public function getCategory(): ProductCategory {
        return $this->category;
    }

    public function setCategory(ProductCategory $category) {
        $this->category = $category;
    }


}
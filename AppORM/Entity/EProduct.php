<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

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
    private $id;

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

    #[ORM\OneToMany(targetEntity: EOrderItem::class, mappedBy: 'product', cascade: ['persist'])]
    private Collection $orderItems;

    #[ORM\ManyToMany(targetEntity: EAllergens::class, inversedBy: 'products', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'product_allergens')]
    private Collection $allergens;

    private static $entity = EProduct::class;

    //constructor
    public function __construct($name, $description, $cost, ProductCategory $category) {
        $this->category = $category;
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
        $this->availability = true;
    }   

    //methods getters and setters

    public static function getEntity() {
        return self::$entity;
    }

    public function getIdProduct() {
        return $this->id;
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

    public function isAvailable(): bool {
        return $this->availability;
    }

    public function getCategory(): ProductCategory {
        return $this->category;
    }

    public function setCategory(ProductCategory $category) {
        $this->category = $category;
    }

    public function getOrderItems(): Collection {
        return $this->orderItems;
    }
    
    public function setOrderItems(Collection $orderItems) {
        $this->orderItems = $orderItems;
    }
}
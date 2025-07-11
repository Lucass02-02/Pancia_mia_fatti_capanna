<?php // File: AppORM/Entity/EProduct.php
namespace AppORM\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class EProduct
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private  $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $cost;
    
    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private bool $availability;

    #[ORM\ManyToOne(targetEntity: EProductCategory::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: false)]
    private EProductCategory $category;

    #[ORM\OneToMany(targetEntity: EOrderItem::class, mappedBy: 'product', cascade: ['persist'])]
    private Collection $orderItems;

    #[ORM\ManyToMany(targetEntity: EAllergens::class, inversedBy: 'product')]
    #[ORM\JoinTable(name: 'product_allergens')]
    private Collection $allergens;

    private static $entity = EProduct::class;

    public function __construct(string $name, string $description, float $cost, EProductCategory $category)
    {
        $this->category = $category;
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
        $this->availability = true; 
        $this->allergens = new ArrayCollection();
    }   

    //methods getters and setters

    public function getEntity() {
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

    public function setAvailability($availability) {
        $this->availability = $availability;
    }

    public function getCategory(): EProductCategory {
        return $this->category;
    }

    public function setCategory(EProductCategory $category) {
        $this->category = $category;
    }

    public function getOrderItems(): Collection {
        return $this->orderItems;
    }
    
    public function setOrderItems(Collection $orderItems) {
        $this->orderItems = $orderItems;
    }

     public function getAllergens(): Collection
    {
        return $this->allergens;
    }

    public function addAllergen(EAllergens $allergen): void
    {
        if (!$this->allergens->contains($allergen)) {
            $this->allergens->add($allergen);
            $allergen->addProduct($this);
        }
    }

    public function removeAllergen(EAllergens $allergen): void
    {
        if ($this->allergens->contains($allergen)) {
            $this->allergens->removeElement($allergen);
            $allergen->removeProduct($this);
        }
    }

    public function clearAllergens(): void {
        $this->allergens->clear();
    }
}
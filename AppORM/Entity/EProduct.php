<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection; // Aggiunto per ArrayCollection

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

    #[ORM\ManyToMany(targetEntity: EOrder::class, inversedBy: 'products')]
    #[ORM\JoinTable(name: 'order_products')]
    private Collection $orders;

    #[ORM\ManyToMany(targetEntity: EAllergens::class, inversedBy: 'products')]
    #[ORM\JoinTable(name: 'product_allergens')]
    private Collection $allergens;

    //constructor
    public function __construct(string $name, string $description, float $cost, ProductCategory $category) {
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
        $this->category = $category;
        $this->availability = true; // Default
        $this->orders = new ArrayCollection();
        $this->allergens = new ArrayCollection();
    }

    //methods getters and setters

    public function getEntity(): string {
        return self::class;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;
        return $this;
    }

    public function getCost(): float {
        return $this->cost;
    }

    public function setCost(float $cost): self {
        $this->cost = $cost;
        return $this;
    }

    public function getAvailability(): bool {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self {
        $this->availability = $availability;
        return $this;
    }

    public function getCategory(): ProductCategory {
        return $this->category;
    }

    public function setCategory(ProductCategory $category): self {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Collection<int, EOrder>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(EOrder $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
        }
        return $this;
    }

    public function removeOrder(EOrder $order): self
    {
        $this->orders->removeElement($order);
        return $this;
    }

    /**
     * @return Collection<int, EAllergens>
     */
    public function getAllergens(): Collection
    {
        return $this->allergens;
    }

    public function addAllergen(EAllergens $allergen): self
    {
        if (!$this->allergens->contains($allergen)) {
            $this->allergens->add($allergen);
        }
        return $this;
    }

    public function removeAllergen(EAllergens $allergen): self
    {
        $this->allergens->removeElement($allergen);
        return $this;
    }
}
<?php
// File: AppORM/Entity/EProduct.php (AGGIORNATO CON I SETTER)

namespace AppORM\Entity;

use Collator;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class EProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private bool $availability = true;

    #[ORM\ManyToOne(targetEntity: EProductCategory::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: false)]
    private EProductCategory $category;

    #[ORM\ManyToMany(targetEntity: EAllergens::class, inversedBy: 'product')]
    #[ORM\JoinTable(name: 'products_allergens')]
    private Collection $allergens;

    #[ORM\OneToMany(targetEntity: EOrderItem::class, mappedBy: 'product')]
    private Collection $orderItems;

    public function __construct(string $name, string $description, float $price, EProductCategory $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->allergens = new ArrayCollection();
        $this->availability = true;
    }

    
    public function getIdProduct(): ?int {
         return $this->id; 
    }

    public function getName(): string {
         return $this->name; 
    }

    public function getDescription(): string {
         return $this->description; 
    }

    public function getPrice(): float {
         return $this->price; 
    }

    public function getCategory(): EProductCategory {
         return $this->category; 
    }

    public function getAllergens(): Collection {
         return $this->allergens; 
    }

    public function isAvailable(): bool {
         return $this->availability; 
    }

    
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Imposta una nuova descrizione per il prodotto.
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Imposta un nuovo prezzo per il prodotto.
     * @param float $price
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Imposta lo stato di disponibilità del prodotto.
     * @param bool $available
     * @return self
     */
    public function setAvailability(bool $available): self
    {
        $this->availability = $available;
        return $this;
    }


    public function addAllergen(EAllergens $allergen): void
    {
        if (!$this->allergens->contains($allergen)) {
            $this->allergens->add($allergen);
        }
    }

    public function removeAllergen(EAllergens $allergen): void
    {
        if ($this->allergens->contains($allergen)) {
            $this->allergens->removeElement($allergen);
        }
    }
    public function clearAllergens(): void
    {
    $this->allergens->clear();
    }

    public function setCategory(EProductCategory $category): void
    {
        $this->category = $category;
    }

    public function getOrderItems() {
        return $this->orderItems;
    }
}
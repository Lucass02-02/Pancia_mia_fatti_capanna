<?php // File: AppORM/Entity/EProduct.php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

// L'enum ProductCategory è stato spostato nel suo file.
// La classe EProduct ora inizia direttamente qui.

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class EProduct
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $price;

    // Nota come ora usiamo l'enum che è definito nel suo file.
    #[ORM\Column(type: 'string', enumType: ProductCategory::class)]
    private ProductCategory $category;
    
    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private bool $availability = true;

    /**
     * @var Collection<int, EAllergens>
     */
    #[ORM\ManyToMany(targetEntity: EAllergens::class, inversedBy: 'products', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'products_allergens')]
    private Collection $allergens;

    public function __construct(string $name, string $description, float $price, ProductCategory $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->allergens = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }
    public function getCategory(): ProductCategory { return $this->category; }
    public function isAvailable(): bool { return $this->availability; }
    public function setAvailability(bool $availability): void { $this->availability = $availability; }

    /**
     * @return Collection<int, EAllergens>
     */
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
}

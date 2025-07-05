<?php
// File: AppORM/Entity/EProduct.php (con aggiunta di $availability)

namespace AppORM\Entity;

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
    
    // Il costruttore rimane invariato
    public function __construct(string $name, string $description, float $price, EProductCategory $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->allergens = new ArrayCollection();
        $this->availability = true; // Assicuriamoci che sia disponibile alla creazione
    }

    // --- Metodi Getter ---
    
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }
    public function getCategory(): EProductCategory { return $this->category; }
    public function getAllergens(): Collection { return $this->allergens; }
    
    /**
     * NUOVO METODO GETTER
     * Metodo per recuperare lo stato di disponibilità.
     */
    public function isAvailable(): bool { return $this->availability; }

    // --- Metodi Setter ---

    /**
     * NUOVO METODO SETTER
     * Questo metodo è chiamato da FProduct::setAvailability e ora funzionerà correttamente.
     */
    public function setAvailability(bool $available): self
    {
        $this->availability = $available;
        return $this;
    }
    
    // Metodi per gestire le relazioni (invariati)
    public function addAllergen(EAllergens $allergen): void { /* ... */ }
    public function removeAllergen(EAllergens $allergen): void { /* ... */ }
}
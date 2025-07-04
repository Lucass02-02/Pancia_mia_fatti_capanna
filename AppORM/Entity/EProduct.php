<?php
// File: AppORM/Entity/EProduct.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

<<<<<<< Updated upstream
// L'enum ProductCategory è stato spostato nel suo file.
// La classe EProduct ora inizia direttamente qui.

=======
>>>>>>> Stashed changes
#[ORM\Entity]
#[ORM\Table(name: 'products')]
class EProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
<<<<<<< Updated upstream
=======
    #[ORM\Column(type: 'integer')]
>>>>>>> Stashed changes
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    /**
     * QUESTA È LA PROPRIETÀ CHE MANCAVA
     */
    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $price;

<<<<<<< Updated upstream
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
=======
    #[ORM\ManyToOne(targetEntity: EProductCategory::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: false)]
    private EProductCategory $category;

    #[ORM\ManyToMany(targetEntity: EAllergens::class, inversedBy: 'product')]
    #[ORM\JoinTable(name: 'products_allergens')]
    private Collection $allergens;


    // Il costruttore è già corretto e accetta la descrizione
    public function __construct(string $name, string $description, float $price, EProductCategory $category)
    {
        $this->name = $name;
        $this->description = $description; // e la assegna qui
>>>>>>> Stashed changes
        $this->price = $price;
        $this->category = $category;
        $this->allergens = new ArrayCollection();
    }

<<<<<<< Updated upstream
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
=======
    // --- Metodi Getter ---
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Questo metodo ora funzionerà perché la proprietà $this->description esiste.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCategory(): EProductCategory
    {
        return $this->category;
    }

>>>>>>> Stashed changes
    public function getAllergens(): Collection
    {
        return $this->allergens;
    }

    // --- Metodi per gestire le relazioni ---

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
}

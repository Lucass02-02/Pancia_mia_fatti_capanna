<?php
// File: AppORM/Entity/EProduct.php

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

    /**
     * QUESTA È LA PROPRIETÀ CHE MANCAVA
     */
    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $price;

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
        $this->price = $price;
        $this->category = $category;
        $this->allergens = new ArrayCollection();
    }

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
<?php
// Posizione: AppORM/Entity/EAllergens.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'allergens')]
class EAllergens
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private string $allergenType;

    
    /**
     * @var Collection<int, EProduct>
     */
    #[ORM\ManyToMany(targetEntity: EProduct::class, mappedBy: 'allergens')]
    private Collection $products;

    public function __construct(string $allergenType)
    {
        $this->allergenType = $allergenType;
        // Inizializza la collezione come un array vuoto.
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getAllergenType(): string { return $this->allergenType; }
    public function setAllergenType(string $type): void { $this->allergenType = $type; }


    /**
     * @return Collection<int, EProduct>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * Metodo di supporto chiamato da EProduct.addAllergen()
     * per mantenere la coerenza.
     */
    public function addProduct(EProduct $product): void
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }
    }

    /**
     * Metodo di supporto chiamato da EProduct.removeAllergen()
     */
    public function removeProduct(EProduct $product): void
    {
        $this->products->removeElement($product);
    }
}

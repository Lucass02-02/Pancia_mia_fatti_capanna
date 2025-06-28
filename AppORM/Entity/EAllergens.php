<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity]
#[ORM\Table(name: 'allergens')]
class EAllergens {

    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $id;


    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $allergenType;

    #[ORM\ManyToMany(targetEntity: EProduct::class, mappedBy: 'allergens')]
    private Collection $products;

    //constructor

    public function __construct(string $allergenType) {
        $this->allergenType = $allergenType;
        $this->products = new ArrayCollection();
    }

    //methods getters and setters
    public function getEntity(): string {
        return self::class;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getAllergenType(): string {
        return $this->allergenType;
    }

    public function setAllergenType(string $allergenType): self {
        $this->allergenType = $allergenType;
        return $this;
    }

    // Metodi per la gestione dei Prodotti (lato Inverse Side)
    public function getProducts(): Collection {
        return $this->products;
    }

    // Metodo per aggiungere un prodotto a questa collezione di allergeni (usato per coerenza bidirezionale)
    public function addProduct(EProduct $product): self {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }
        return $this;
    }

    // Metodo per rimuovere un prodotto da questa collezione di allergeni (usato per coerenza bidirezionale)
    public function removeProduct(EProduct $product): self {
        $this->products->removeElement($product);
        return $this;
    }
}
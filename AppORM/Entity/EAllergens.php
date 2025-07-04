<?php
// Posizione: AppORM/Entity/EAllergens.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use AppORM\Entity\EProduct;

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

    #[ORM\ManyToMany(targetEntity: EProduct::class, mappedBy: 'allergens', cascade: ['persist'])]
    private Collection $product;

    private static $entity = EAllergens::class;

    public function __construct(string $allergenType)
    {
        $this->allergenType = $allergenType;
    }

    //methods getters and setters
    public static function getEntity() {
        return self::$entity;
    }


    public function getIdAllergens() {
        return $this->id;
    }

    public function getAllergenType() {
        return $this->allergenType;
    }

    public function setAllergenType($allergenType) {
        $this->allergenType = $allergenType;
    }

    public function getProduct(): Collection {
        return $this->product;
    }

    /**
     * Metodo di supporto chiamato da EProduct.addAllergen()
     * per mantenere la coerenza.
     */
    public function addProduct(EProduct $product): void
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
        }
    }

    /**
     * Metodo di supporto chiamato da EProduct.removeAllergen()
     */
    public function removeProduct(EProduct $product): void
    {
        $this->product->removeElement($product);
    }
}

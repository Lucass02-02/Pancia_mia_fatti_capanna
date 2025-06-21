<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;


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
    private Collection $product;

    //constructor

    public function __construct($allergenType) {
        $this->allergenType = $allergenType;
    }

    //methods getters and setters
    public function getIdAllergens() {
        return $this->id;
    }

    public function getAllergenType() {
        return $this->allergenType;
    }

    public function setAllergenType($allergenType) {
        $this->allergenType = $allergenType;
    }

}
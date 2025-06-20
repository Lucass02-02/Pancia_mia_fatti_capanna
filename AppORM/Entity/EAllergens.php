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
    private $idAllergens;


    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $allergenType;


    //constructor

    public function __construct($allergenType) {
        $this->allergenType = $allergenType;
    }

    //methods getters and setters
    public function getIdAllergens() {
        return $this->idAllergens;
    }

    public function getAllergenType() {
        return $this->allergenType;
    }

    public function setAllergenType($allergenType) {
        $this->allergenType = $allergenType;
    }

}
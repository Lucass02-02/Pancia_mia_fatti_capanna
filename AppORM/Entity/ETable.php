<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tables')]
class ETable {

    
    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $idTable;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $seatsNumber;

    #[ORM\Column(type: 'string', nullable: false)]
    private $state;


    //constructor
    public function __construct($seatsNumber, $state) {
        $this->seatsNumber = $seatsNumber;
        $this->state = $state;
    }

    //methods getters and setters

    public function getIdTable() {
        return $this->idTable;
    }
    
    public function getSeatsNumber() {
        return $this->seatsNumber;
    }

    public function setSeatsNumber($seatsNumber) {
        $this->seatsNumber = $seatsNumber;
    }
    
    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    
}
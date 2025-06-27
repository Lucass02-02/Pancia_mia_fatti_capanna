<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;

enum TableState: string {
    case AVAILABLE = 'available';
    case RESERVED = 'reserved';
    case OCCUPIED = 'occupied';
}

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
    private TableState $state;

    #[ORM\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'tables')]
    #[ORM\JoinColumn(name: 'hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurantHall;

    #[ORM\ManyToMany(targetEntity: EReservation::class, mappedBy: 'tables')]
    private Collection $reservations;

    private static $entity = ETable::class;

    //constructor
    public function __construct($seatsNumber, TableState $state) {
        $this->seatsNumber = $seatsNumber;
        $this->state = $state;
    }

    //methods getters and setters

    public static function getEntity() {
        return self::$entity;
    }

    public function getIdTable() {
        return $this->idTable;
    }
    
    public function getSeatsNumber() {
        return $this->seatsNumber;
    }

    public function setSeatsNumber($seatsNumber) {
        $this->seatsNumber = $seatsNumber;
    }
    
    public function getState(): TableState {
        return $this->state;
    }

    public function setState(TableState $state) {
        $this->state = $state;
    }

    
}
<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    #[ORM\Column(type: 'string', nullable: false, enumType: TableState::class)]
    private TableState $state;

    #[ORM\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'table', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurantHall;

    #[ORM\OneToMany(targetEntity: EReservationTable::class, mappedBy: 'table', cascade: ['persist'])]
    private Collection $reservations;

    private static $entity = ETable::class;

    
    public function __construct($seatsNumber) {
        $this->seatsNumber = $seatsNumber;
        $this->state = TableState::AVAILABLE; 
        $this->reservations = new ArrayCollection();
    }
    

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


    /**
     * Returns a collection of reservations for this table.
     * @return \Doctrine\Common\Collections\Collection|array
     */
    public function getReservationTables() {
        // Assuming $this->reservations holds the reservations collection
        return $this->reservations;
    }


    public function setRestaurantHall(ERestaurantHall $restaurantHall) {
        $this->restaurantHall = $restaurantHall;
    }

    public function getRestaurantHall(): ERestaurantHall {
        return $this->restaurantHall;
    }
    
}
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

    #[ORM\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'tables', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurantHall;

    #[ORM\OneToMany(targetEntity: EReservationTable::class, mappedBy: 'table', cascade: ['persist'])]
    private Collection $reservations;

    private static $entity = ETable::class;

    
    public function __construct($seatsNumber) {
        $this->seatsNumber = $seatsNumber;
        $this->state = TableState::AVAILABLE; // Default state when a table is created
        $this->reservations = new ArrayCollection();
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

    /*public function addReservation(EReservation $reservation) {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            if (!$reservation->getTable()->contains($this)) { //messo per evitare errori silenziosi nel caso $reservation->getTable non sia inizializzata
                 $reservation->addTable($this);
            }           
        }
    }*/
    
}
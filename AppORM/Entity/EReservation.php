<?php

namespace AppORM\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

enum ReservationStatus: string {
    case CREATED = 'created';
    case APPROVED = 'approved';
    case ORDER_IN_PROGRESS = 'order_in_progress';
    case ENDED = 'ended';
    case CANCELED = 'canceled';
}

#[ORM\Entity]
#[ORM\Table(name: 'reservations')]
class EReservation {

    //attributes

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $idReservation;

    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $duration;

    #[ORM\Column(type: 'time', nullable: false)]
    private $hours;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $peopleNum;

    #[ORM\Column(type: 'text', nullable: true)]
    private $note;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $nameReservation;

    #[ORM\Column(type: 'string', length: 20, nullable: false, enumType: ReservationStatus::class)]
    private ReservationStatus $status;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]        
    private ?EClient $client = null;

    #[ORM\OneToMany(targetEntity: EOrder::class, mappedBy: 'reservation', cascade: ['persist'])]
    private Collection $orders;

    #[ORM\OneToMany(targetEntity: EReservationTable::class, mappedBy: 'reservation', cascade: ['persist'])]
    private Collection $table;

    //questa la puoi togliere
    #[ORM\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'restaurant_hall_id', referencedColumnName: 'idHall')]
    private ?ERestaurantHall $restaurantHall = null;

    #[ORM\ManyToOne(targetEntity: ETurn::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'turn_id', referencedColumnName: 'idTurn')]
    private ?ETurn $turn = null;

    private static $entity = EReservation::class;

    //constructor
    public function __construct( $date, $hours, ?int $duration , int $peopleNum, string $nameReservation, ?string $note = null)
 {
        $this->date = $date;
        $this->hours = $hours;
        $this->duration = $duration;
        $this->peopleNum = $peopleNum;
        $this->note = $note;
        $this->nameReservation = $nameReservation;
        $this->table = new ArrayCollection(); 
        $this->status = ReservationStatus::CREATED;
    }

    //methods getters and setters

    public static function getEntity() {
        return self::$entity;
    }

    public function getIdReservation() {
        return $this->idReservation;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getHours() {
        return $this->hours;
    }

    public function setHours($hours) {
        $this->hours = $hours;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
    }

    public function getPeopleNum() {
        return $this->peopleNum;
    }

    public function setPeopleNum($peopleNum) {
        $this->peopleNum = $peopleNum;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getNameReservation() {
        return $this->nameReservation;
    }

    public function setNameReservation($nameReservation) {
        $this->nameReservation = $nameReservation;
    }

    public function getStatus(): ReservationStatus {
        return $this->status;
    }

    public function setStatus(ReservationStatus $status): void {
        $this->status = $status;
    }

    public function getClient() {
        return $this->client;
    }

    public function setClient(EClient $client): void {
        $this->client = $client;
    }

    public function getTable() {
        return $this->table;
    }
    
    public function getOrders(): Collection {
        return $this->orders;
    }

    public function getRestaurantHall() {
        return $this->restaurantHall;
    }

    public function setRestaurantHall(ERestaurantHall $restaurantHall): void {
        $this->restaurantHall = $restaurantHall;
    }

    public function getTurn() {
        return $this->turn;
    }

    public function setTurn(ETurn $turn): void {
        $this->turn = $turn;
    }

    public function addTableReservation(EReservationTable $reservationTable): void {
        if (!$this->table->contains($reservationTable)) {
            $this->table->add($reservationTable);
            $reservationTable->setReservation($this); // Ensure the reservation is set in the table reservation
        }
    }

}
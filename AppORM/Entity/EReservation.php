<?php

namespace AppORM\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]        
    private EClient $client;

    #[ORM\ManyToMany(targetEntity: ETable::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinTable(
        name: 'reservation_tables',
        joinColumns: [
            new ORM\JoinColumn(name: 'reservation_id', referencedColumnName: 'idReservation')
    ],  
        inverseJoinColumns: [
            new ORM\JoinColumn(name: 'table_id', referencedColumnName: 'idTable')
        ]
    )]  
    private Collection $table;

    #[ORM\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'restaurant_hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurantHall;

    #[ORM\ManyToOne(targetEntity: ETurn::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'turn_id', referencedColumnName: 'idTurn')]
    private ETurn $turn;

    private static $entity = EReservation::class;

    //constructor
    public function __construct( $date, $hours, $duration, $peopleNum, $note, $nameReservation) {
        $this->date = $date;
        $this->hours = $hours;
        $this->duration = $duration;
        $this->peopleNum = $peopleNum;
        $this->note = $note;
        $this->nameReservation = $nameReservation;
        $this->table = new ArrayCollection();
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

    public function getClient(): EClient {
        return $this->client;
    }

    public function setClient(EClient $client): void {
        $this->client = $client;
    }

    public function getTable() {
        return $this->table;
    }
    

    public function getRestaurantHall(): ERestaurantHall {
        return $this->restaurantHall;
    }

    public function setRestaurantHall(ERestaurantHall $restaurantHall): void {
        $this->restaurantHall = $restaurantHall;
    }

    public function getTurn(): ETurn {
        return $this->turn;
    }

    public function setTurn(ETurn $turn): void {
        $this->turn = $turn;
    }

    public function addTable(ETable $table): void {
        if (!$this->table->contains($table)) {
            $this->table->add($table);
            $table->addReservation($this); 
        }
    }

}
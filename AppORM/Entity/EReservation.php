<?php

namespace AppORM\Entity;
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

    #[ORM\Column(type: 'time', nullable: false)]
    private $hours;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $peopleNum;

    #[ORM\Column(type: 'text', nullable: true)]
    private $note;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $nameReservation;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]        
    private EClient $client;

    #[ORM\ManyToOne(targetEntity: ETable::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(name: 'table_id', referencedColumnName: 'idTable')]    
    private ETable $table;

    //constructor
    public function __construct( $date, $hours, $peopleNum, $note, $nameReservation) {
        $this->date = $date;
        $this->hours = $hours;
        $this->peopleNum = $peopleNum;
        $this->note = $note;
        $this->nameReservation = $nameReservation;
    }

    //methods getters and setters

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

    
}
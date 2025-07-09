<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'reservation_tables')]
#[ORM\UniqueConstraint(name: 'unique_reservation_table', columns: ['table_id', 'date', 'startTime', 'endTime'] )]
class EReservationTable {

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $reservationTableId;

    #[ORM\ManyToOne(targetEntity: EReservation::class, inversedBy: 'table', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'reservation_id', referencedColumnName: 'idReservation')]
    private EReservation $reservation;

    #[ORM\ManyToOne(targetEntity: ETable::class, inversedBy: 'reservations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'table_id', referencedColumnName: 'idTable')]
    private ETable $table;

    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    #[ORM\Column(type: 'time', nullable: false)]
    private $startTime;

    #[ORM\Column(type: 'time', nullable: false)]
    private $endTime;

    private static $entity = EReservationTable::class;

    public function __construct() {
        
    }

    public static function getEntity() {
        return self::$entity;
    }

    public function getReservationTableId() {
        return $this->reservationTableId;
    }

    public function getReservation(): EReservation {
        return $this->reservation;
    }

    public function setReservation(EReservation $reservation) {
        $this->reservation = $reservation;
    }

    public function getTable(): ETable {
        return $this->table;
    }

    public function setTable(ETable $table) {
        $this->table = $table;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }

}
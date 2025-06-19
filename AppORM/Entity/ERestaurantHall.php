<?php

class ERestaurantHall {

    //attributes

    private array $table;

    private $ReservationNum;

    //constructor

    public function __construct(array $table = [], $ReservationNum = 0) {
        $this->table = $table;
        $this->ReservationNum = $ReservationNum;
    }

    //methods getters and setters

    public function getTable() {
        return $this->table;
    }

    public function setTable(array $table) {
        $this->table = $table;
    }

    public function getReservationNum() {
        return $this->ReservationNum;
    }

    public function setReservationNum($ReservationNum) {
        $this->ReservationNum = $ReservationNum;
    }

    

}
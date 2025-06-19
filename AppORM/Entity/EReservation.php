<?php

class EPrenotazione  {


    //attributes
    private $id;

    private $date;

    private $hours;

    private $peopleNum;

    private $note;

    private ETable $table;

    private $nameReservation;

    private EClient $userData;


    //constructor
    public function __construct($id, $date, $hours, $peopleNum, $note, ETavolo $table, ECliente $userData, $nameReservation = null) {
        $this->id = $id;
        $this->date = $date;
        $this->hours = $hours;
        $this->peopleNum = $peopleNum;
        $this->note = $note;
        $this->table = $table;
        $this->userData = $userData;
        $this->nameReservation = $nameReservation;
    }

    //methods getters and setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function getTable() {
        return $this->table;
    }

    public function setTable(ETable $table) {
        $this->table = $table;
    }

    public function getNameReservation() {
        return $this->nameReservation;
    }

    public function setNameReservation($nameReservation) {
        $this->nameReservation = $nameReservation;
    }

    public function getUserData() {
        return $this->userData;
    }

    public function setUserData(EClient $userData) {
        $this->userData = $userData;
    }

    
}
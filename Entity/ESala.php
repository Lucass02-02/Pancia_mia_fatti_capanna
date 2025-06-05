<?php

class ESala {

    //attributes

    private array $tavoli;

    private $numPrenotazioni;

    //constructor

    public function __construct(array $tavoli = [], $numPrenotazioni = 0) {
        $this->tavoli = $tavoli;
        $this->numPrenotazioni = $numPrenotazioni;
    }

    //methods getters and setters

    public function getTavoli() {
        return $this->tavoli;
    }

    public function setTavoli(array $tavoli) {
        $this->tavoli = $tavoli;
    }

    public function getNumPrenotazioni() {
        return $this->numPrenotazioni;
    }

    public function setNumPrenotazioni($numPrenotazioni) {
        $this->numPrenotazioni = $numPrenotazioni;
    }

    

}
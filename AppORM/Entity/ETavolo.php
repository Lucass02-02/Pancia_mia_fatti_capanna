<?php

class ETavolo {

    
    //attributes
    private $numTavolo;

    private $stato;


    //constructor
    public function __construct($numTavolo, $stato) {
        $this->numTavolo = $numTavolo;
        $this->stato = $stato;
    }

    //methods getters and setters
    public function getNumTavolo() {
        return $this->numTavolo;
    }

    public function setNumTavolo($numTavolo) {
        $this->numTavolo = $numTavolo;
    }
    
    public function getStato() {
        return $this->stato;
    }

    public function setStato($stato) {
        $this->stato = $stato;
    }

    
}
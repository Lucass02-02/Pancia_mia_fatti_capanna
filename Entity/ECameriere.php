<?php

class ECameriere extends EUtente {
    
    //attributes
    protected $idCameriere;


    //constructor
    public function __construct($name, $surname, $email, $password, $idCameriere) {
        parent::__construct($name, $surname, $email, $password);
        $this->idCameriere = $idCameriere;
    }

    //methods getters and setters
    public function getIdCameriere() {
        return $this->idCameriere;
    }

    public function setIdCameriere($idCameriere) {
        $this->idCameriere = $idCameriere;
    }
}
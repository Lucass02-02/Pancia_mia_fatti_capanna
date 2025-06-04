<?php

class EProprietario extends EUtente {

    //attributes
    protected $idProprietario;

    //constructor
    public function __construct($name, $surname, $email, $password, $idProprietario) {
        parent::__construct($name, $surname, $email, $password);
        $this->idProprietario = $idProprietario;
    }

    //methods getters and setters
    public function getIdProprietario() {
        return $this->idProprietario;
    }

    public function setIdProprietario($idProprietario) {
        $this->idProprietario = $idProprietario;
    }
}
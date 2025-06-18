<?php

class ECliente extends EUtente {

    //attributes
    protected $idCliente;

    private array $metodiSalvati;

    
    //constructor
    public function __construct($idUtente, $nome, $cognome, $email, $password, $idCliente = null) {
        parent::__construct($idUtente, $nome, $cognome, $email, $password);
        $this->idCliente = $idCliente;
        $this->metodiSalvati = [];
    }

    
    //methods getters and setters
    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function getMetodiSalvati() {
        return $this->metodiSalvati;
    }

    public function setMetodiSalvati(array $metodiSalvati) {
        $this->metodiSalvati = $metodiSalvati;
    }
}
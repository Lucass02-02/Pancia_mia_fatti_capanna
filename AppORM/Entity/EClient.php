<?php

class EClient extends EUser {

    //attributes
    protected $idClient;

    private array $savedMethods;

    
    //constructor
    public function __construct($name, $surname, $email, $password ) {
        parent::__construct( $nome, $cognome, $email, $password);
        $this->idClient = $idClient;
        $this->savedMethods = [];
    }

    
    //methods getters and setters
    public function getIdClient() {
        return $this->idClient;
    }

    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function getSavedMethods() {
        return $this->savedMethods;
    }

    public function setSavedMethods(array $savedMethods) {
        $this->savedMethods = $savedMethods;
    }
}
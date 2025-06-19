<?php

class EAdmin extends EUser {

    //attributes
    protected $idAdmin;

    //constructor
    public function __construct($name, $surname, $email, $password, $idAdmin) {
        parent::__construct($name, $surname, $email, $password);
        $this->idAdmin = $idAdmin;
    }

    //methods getters and setters
    public function getIdAdmin() {
        return $this->idAdmin;
    }

    public function setIdAdmin($idAdmin) {
        $this->idAdmin = $idAdmin;
    }
}
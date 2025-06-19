<?php

class ECreditCard {

    //attributes

    private $nominative;

    private $number;

    private $CVV;

    private $expirationDate;

    private $name;

    //constructor
    public function __construct($nominative, $number, $CVV, $expirationDate, $name) {
        $this->nominative = $nominative;
        $this->number = $number;
        $this->CVV = $CVV;
        $this->expirationDate = $expirationDate;
        $this->name = $name;
    }


    //methods getters and setters

    public function getNominative() {
        return $this->nominative;
    }

    public function setNominative($nominative) {
        $this->nominative = $nominative;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getCVV() {
        return $this->CVV;
    }

    public function setCVV($CVV) {
        $this->CVV = $CVV;
    }

    public function getExpirationDate() {
        return $this->expirationDate;
    }

    public function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    
}
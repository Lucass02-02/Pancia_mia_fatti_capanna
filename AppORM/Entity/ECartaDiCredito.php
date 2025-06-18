<?php

class ECartaDiCredito {

    //attributes

    private $nominativo;

    private $numero;

    private $CVV;

    private $datascadenza;

    private $nome;

    //constructor
    public function __construct($nominativo, $numero, $CVV, $datascadenza, $nome) {
        $this->nominativo = $nominativo;
        $this->numero = $numero;
        $this->CVV = $CVV;
        $this->datascadenza = $datascadenza;
        $this->nome = $nome;
    }


    //methods getters and setters

    public function getNominativo() {
        return $this->nominativo;
    }

    public function setNominativo($nominativo) {
        $this->nominativo = $nominativo;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getCVV() {
        return $this->CVV;
    }

    public function setCVV($CVV) {
        $this->CVV = $CVV;
    }

    public function getDatascadenza() {
        return $this->datascadenza;
    }

    public function setDatascadenza($datascadenza) {
        $this->datascadenza = $datascadenza;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    
}
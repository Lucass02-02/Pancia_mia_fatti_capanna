<?php

class ERecensione {

    //attributes

    private $id;

    private $descrizione;

    private $voto;

    private $data;

    private $ora;

    //constructor

    public function __construct($id, $descrizione, $voto, $data, $ora) {
        $this->id = $id;
        $this->descrizione = $descrizione;
        $this->voto = $voto;
        $this->data = $data;
        $this->ora = $ora;
    }

    //methods getters and setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescrizione() {
        return $this->descrizione;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    public function getVoto() {
        return $this->voto;
    }

    public function setVoto($voto) {
        $this->voto = $voto;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getOra() {
        return $this->ora;
    }

    public function setOra($ora) {
        $this->ora = $ora;
    }

}
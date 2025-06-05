<?php

class EOrdine {

    //attributes

    private $id;

    private array $prodotti;

    private $note;

    private float $prezzo;

    private $data;

    private ETavolo $tavolo;

    //constructor

    public function __construct($id, array $prodotti, $note, float $prezzo, $data, ETavolo $tavolo) {
        $this->id = $id;
        $this->prodotti = $prodotti;
        $this->note = $note;
        $this->prezzo = $prezzo;
        $this->data = $data;
        $this->tavolo = $tavolo;
    }

    //methods getters and setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProdotti() {
        return $this->prodotti;
    }

    public function setProdotti(array $prodotti) {
        $this->prodotti = $prodotti;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getPrezzo() {
        return $this->prezzo;
    }

    public function setPrezzo(float $prezzo) {
        $this->prezzo = $prezzo;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getTavolo() {
        return $this->tavolo;
    }

    public function setTavolo(ETavolo $tavolo) {
        $this->tavolo = $tavolo;
    }
    
}
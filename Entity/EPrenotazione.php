<?php

class EPrenotazione  {


    //attributes
    private $id;

    private $data;

    private $orario;

    private $numPersone;

    private $note;

    private ETavolo $tavolo;

    private $nomePrenotazione;

    private ECliente $datiUtente;


    //constructor
    public function __construct($id, $data, $orario, $numPersone, $note, ETavolo $tavolo, ECliente $datiUtente, $nomePrenotazione = null) {
        $this->id = $id;
        $this->data = $data;
        $this->orario = $orario;
        $this->numPersone = $numPersone;
        $this->note = $note;
        $this->tavolo = $tavolo;
        $this->datiUtente = $datiUtente;
        $this->nomePrenotazione = $nomePrenotazione;
    }

    //methods getters and setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getOrario() {
        return $this->orario;
    }

    public function setOrario($orario) {
        $this->orario = $orario;
    }

    public function getNumPersone() {
        return $this->numPersone;
    }

    public function setNumPersone($numPersone) {
        $this->numPersone = $numPersone;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getTavolo() {
        return $this->tavolo;
    }

    public function setTavolo(ETavolo $tavolo) {
        $this->tavolo = $tavolo;
    }

    public function getNomePrenotazione() {
        return $this->nomePrenotazione;
    }

    public function setNomePrenotazione($nomePrenotazione) {
        $this->nomePrenotazione = $nomePrenotazione;
    }

    public function getDatiUtente() {
        return $this->datiUtente;
    }

    public function setDatiUtente(ECliente $datiUtente) {
        $this->datiUtente = $datiUtente;
    }

    
}
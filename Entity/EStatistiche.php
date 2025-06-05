<?php

class EStatistiche {

    //attributes

    private array $piattiPiùVenduti;

    private array $ClientiAbituali;

    private $scorte;

    private float $FatturatoMensile;

    //constructor

    public function __construct(array $piattiPiùVenduti = [], array $ClientiAbituali = [], $scorte = null, float $FatturatoMensile = 0.0) {
        $this->piattiPiùVenduti = $piattiPiùVenduti;
        $this->ClientiAbituali = $ClientiAbituali;
        $this->scorte = $scorte;
        $this->FatturatoMensile = $FatturatoMensile;
    }

    //methods getters and setters

    public function getPiattiPiùVenduti() {
        return $this->piattiPiùVenduti;
    }

    public function setPiattiPiùVenduti(array $piattiPiùVenduti) {
        $this->piattiPiùVenduti = $piattiPiùVenduti;
    }

    public function getClientiAbituali() {
        return $this->ClientiAbituali;
    }

    public function setClientiAbituali(array $ClientiAbituali) {
        $this->ClientiAbituali = $ClientiAbituali;
    }

    public function getScorte() {
        return $this->scorte;
    }

    public function setScorte($scorte) {
        $this->scorte = $scorte;
    }

    public function getFatturatoMensile() {
        return $this->FatturatoMensile;
    }

    public function setFatturatoMensile(float $FatturatoMensile) {
        $this->FatturatoMensile = $FatturatoMensile;
    }

    

}
<?php

class ECategoria {

    //attributes
    
    private $nome;

    private array $prodotti;


    //constructor

    public function __construct($nome, array $prodotti = []) {
        $this->nome = $nome;
        $this->prodotti = $prodotti;
    }

    //methods getters and setters

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getProdotti() {
        return $this->prodotti;
    }

    public function setProdotti(array $prodotti) {
        $this->prodotti = $prodotti;
    }
}
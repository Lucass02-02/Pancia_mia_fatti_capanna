<?php

class EMenù {

    //attributes
    
    private array $categorie;

    // Constructor
    
    public function __construct(array $categorie = []) {
        $this->categorie = $categorie;
    }

    // Getters and Setters

    public function getCategorie(): array {
        return $this->categorie;
    }

    public function setCategorie(array $categorie): void {
        $this->categorie = $categorie;
    }
}
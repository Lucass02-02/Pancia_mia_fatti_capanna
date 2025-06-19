<?php

class EMenù {

    //attributes
    
    private array $categories;

    // Constructor
    
    public function __construct(array $categories = []) {
        $this->categories = $categories;
    }

    // Getters and Setters

    public function getCategories(): array {
        return $this->categories;
    }

    public function setCategories(array $categories): void {
        $this->categories = $categories;
    }
}
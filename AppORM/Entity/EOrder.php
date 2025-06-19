<?php

class EOrder {

    //attributes

    private $id;

    private array $products;

    private $note;

    private float $cost;

    private $date;

    private ETable $table;

    //constructor

    public function __construct($id, array $products, $note, float $cost, $date, ETavolo $table) {
        $this->id = $id;
        $this->products = $products;
        $this->note = $note;
        $this->cost = $cost;
        $this->date = $date;
        $this->table = $table;
    }

    //methods getters and setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProducts() {
        return $this->products;
    }

    public function setProducts(array $products) {
        $this->products = $products;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getCost() {
        return $this->cost;
    }

    public function setCost(float $cost) {
        $this->cost = $cost;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getTable() {
        return $this->table;
    }

    public function setTable(ETable $table) {
        $this->table = $table;
    }
    
}